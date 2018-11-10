<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerMember;

class MessengerMemberController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerMember();
    }
}
