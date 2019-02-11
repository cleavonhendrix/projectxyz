<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StripeCard;
class StripeCardController extends ClassWorxController
{
    function __construct(){
      $this->model = new StripeCard();
    }
}
