<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessengerMember extends APIModel
{
    protected $table = 'messenger_members';
    protected $fillable = ['messenger_group_id', 'account_id', 'status'];
}
