<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends APIModel
{
    protected $table = 'wishlists';
    protected $fillable = ['account_id', 'payload', 'payload_value'];
}
