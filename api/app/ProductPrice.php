<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends APIModel
{
    protected $table = 'product_prices';
    protected $fillable = ['account_id', 'product_id', 'type', 'price', 'minimum', 'maximum'];
}
