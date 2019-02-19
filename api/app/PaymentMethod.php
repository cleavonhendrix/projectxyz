<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends APIModel
{
    protected $table = 'payment_methods';
    protected $fillable = ['account_id', 'payload', 'payload_value', 'status'];
}
