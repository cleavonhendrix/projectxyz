<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingInformation;
class BillingInformationController extends ClassWorxController
{
    function __construct(){
      $this->model = new BillingInformation();
      $this->notRequired = array(
        'company', 'address', 'city', 'posta_code', 'country', 'state'
      );
    }
}
