<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeCard extends APIModel
{
    protected $table = 'stripe_cards';
    protected $fillable = ['account_id', 'brand', 'last4', 'exp_year', 'exp_month', 'source', 'customer', 'status'];
}
