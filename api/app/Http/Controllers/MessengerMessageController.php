<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerMessage;

class MessengerMessageController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerMessage;
    }
}
