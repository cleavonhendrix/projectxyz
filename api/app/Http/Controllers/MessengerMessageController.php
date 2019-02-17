<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerMessage;
use Carbon\Carbon;

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
          $this->response['data'][$i]['created_at_human'] = Carbon::createFromFormat('Y-m-d H:i:s', $result[$i]['created_at'])->copy()->tz('Asia/Manila')->format('F j, Y');
          $i++;
        }
      }
      return $this->response();
    }
}
