<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
class CouponController extends ClassWorxController
{
   	function __construct(){
   		$this->model = new Coupon();
   	}
}
