<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use phpseclib3\Crypt\AES;

class HomeController extends Controller
{
    private $key;
    private $iv;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $myfile = fopen("key", "r") or die("Unable to open file!");
        $this->key = fread($myfile,filesize("key"));
        fclose($myfile);
        $myfile = fopen("iv", "r") or die("Unable to open file!");
        $this->iv = fread($myfile,filesize("iv"));
        fclose($myfile);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\Response
     */
    public function inbox()
    {
        $user = Auth::user();

        $messages = DB::table('messages')
            ->where('to','=',$user->email)
            ->get();
        return view('inbox')->with(compact('messages'));
    }
    public function sent()
    {
        $user = Auth::user();

        $messages = DB::table('messages')
            ->where('from','=',$user->email)
            ->get();
        return view('sent')->with(compact('messages'));
    }
    public function read($id)
    {
        $message = DB::table('messages')
            ->join('attachments','messages.attachment_id','=','attachments.id')
            ->select('messages.*','attachments.name')
            ->where('messages.id','=',$id)
            ->get()->first();
        return view('read')->with(compact('message'));
    }
    public function compose()
    {
        return view('compose');
    }

    public function store(Request $request)
    {
        // Get the file from the request
        $file = $request->file('file');
        // Get the contents of the file
        $file_contents = $file->openFile()->fread($file->getSize());
        $file_name = $file->getClientOriginalName();
        $file_ext = $file->getClientOriginalExtension();
        $file_mime = $file->getClientMimeType();

        $encrypt_file_content = $this->AESStreamEncode($file_contents);

        $att = Attachment::create([
            'name'=>$file_name,
            'content'=>$encrypt_file_content,
            'extension'=>$file_ext,
            'mime'=>$file_mime,
        ]);
        // Store the contents to the database
        Message::create([
            'from' => Auth::user()->email,
            'to' => $request->email,
            'subject'=> $request->subject,
            'text' => $request->text,
            'user_id'=> Auth::user()->id,
            'attachment_id' => $att->id,
        ]);

        return back()->with('message', 'Your file is submitted Successfully');
    }

    public function get_file($id)
    {
        // Find the user
        $file = Attachment::find($id);

        $decrypt_content = $this->AESStreamDecode($file->content);

        //return $decrypt_content;
        $response = Response::make($decrypt_content, 200);
        $response->header('Cache-Control', 'no-cache private');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Type', $file->mime);
        $response->header('Content-Disposition', 'attachment; filename=' . $file->name);
        $response->header('Content-Transfer-Encoding', 'binary');
        return $response;
    }

    public function AESStreamEncode($input)
    {
        $cipher = new AES('ctr');
        $cipher->setKey($this->key);
        $cipher->setIV($this->iv);
        return $cipher->encrypt($input);
    }

    public function AESStreamDecode($input)
    {
        $cipher = new AES('ctr');
        $cipher->setKey($this->key);
        $cipher->setIV($this->iv);

        return $cipher->decrypt($input);
    }
}
