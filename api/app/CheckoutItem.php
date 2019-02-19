<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends APIModel
{
    protected $table = 'checkout_items';
    protected $fillable = ['checkout_id', 'account_id', 'payload', 'payload_value', 'qty', 'price', 'status'];
}
