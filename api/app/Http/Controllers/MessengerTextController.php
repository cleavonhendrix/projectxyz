<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerText;

class MessengerTextController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerText;
    }
}
