@extends('layouts.app')

@section('content')
    <!--**********************************
            Sidebar start
        ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li><a href="{{ route('email-inbox') }}">Inbox</a></li>
                <li><a href="{{ route('email-sent') }}">Sent</a></li>
                <li><a href="{{ route('email-compose') }}">Compose</a></li>
            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="content-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-right-box">
                                <div class="read-content">
                                    <div class="media pt-5">
                                        <div class="media-body">
                                            <h5 class="m-b-3">{{$message->subject}}</h5>
                                            <p class="m-b-2">{{$message->created_at}}</p>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="media mb-4 mt-1">
                                        <div class="media-body">
                                            <small class="text-muted">From: {{$message->from}} - </small>
                                            <small class="text-muted">To: {{$message->to}}</small>
                                        </div>
                                    </div>
                                    <p>
                                        {{$message->text}}
                                    </p>
                                    <hr>
                                    <h6 class="p-t-15"><i class="fa fa-download mb-2"></i> Attachment</h6>
                                    <div class="row m-b-30">
                                        <div class="col-auto"><a href="{{route('get_file',['id'=>$message->attachment_id])}}" class="text-muted">{{$message->name}}</a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>

    <!-- #/ container -->
    <!--**********************************
    Content body end
    ***********************************-->
@endsection
