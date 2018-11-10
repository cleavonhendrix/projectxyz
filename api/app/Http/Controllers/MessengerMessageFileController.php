<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerMessageFile;

class MessengerMessageFileController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerMessageFile;
    }
}
