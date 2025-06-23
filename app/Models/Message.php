<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'user_id',
        'to',
        'subject',
        'text',
        'attachment_id',
        'encrypt_method',
    ];
}
