<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalTransaction extends APIModel
{
    protected $table = 'paypal_transactions';
    protected $fillable = ['account_id', 'paypal', 'cart', 'email', 'first_name', 'last_name', 'middle_name', 'payer', 'total', 'currency'];
}
