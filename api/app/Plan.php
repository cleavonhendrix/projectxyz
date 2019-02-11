<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends APIModel
{
   	protected $table = 'plans';
    protected $fillable = ['account_id', 'coupon_id', 'order_number', 'title', 'start', 'end', 'price', 'sub_total', 'tax', 'discount', 'total_amount', 'status'];
}
