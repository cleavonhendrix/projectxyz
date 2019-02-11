<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaypalTransaction;
class PaypalTransactionController extends ClassWorxController
{
    function __construct(){
    	$this->model = new PaypalTransaction();
    }
}
