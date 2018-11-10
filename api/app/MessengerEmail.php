<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessengerEmail extends APIModel
{
    protected $table = 'messenger_emails';
    protected $fillable = ['message_id', 'account_id', 'status'];
}
