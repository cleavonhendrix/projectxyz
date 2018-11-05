<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessengerMessageFile extends APIModel
{
    protected $table = 'messenger_message_files';
    protected $fillable = ['message_id', 'url', 'extension'];
}
