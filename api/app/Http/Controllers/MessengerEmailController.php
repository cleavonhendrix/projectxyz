<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerEmail;

class MessengerEmailController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerEmail();
    }
}
