<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessengerText extends APIModel
{
    protected $table = 'messenger_texts';
    protected $fillable = ['message_id', 'account_id', 'status'];
}
