<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessengerMessage extends APIModel
{
    protected $table = 'messenger_messages';
    protected $fillable = ['messenger_group_id', 'account_id', 'message'];
}
