<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerMessage;

class MessengerMessageController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerMessage;
    }

    public function retrieve(Request $request){
      $data = $request->all();
      $this->model = new MessengerMessage();
      $this->retrieveDB($data);
      $result = $this->response['data'];
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $this->response['data'][$i]['account'] = $this->retrieveAccountDetails($result[$i]['account_id']);
          $i++;
        }
      }
      return $this->response();
    }
}
