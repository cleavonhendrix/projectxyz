<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessengerGroup;
use App\MessengerMember;

class MessengerGroupController extends ClassWorxController
{
    function __construct(){
      $this->model = new MessengerGroup();
    }


    public function retrieve(Request $request){
      $data = $request->all();
      $this->retrieveDB($data);

      $result = $this->response['data'];

      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $result[$i]['account_details'] = $this->retrieveAccountDetails($result[$i]['account_id']);
          $result[$i]['total_members'] = $this->getTotalMembers($result[$i]['id']);
          $i++;
        }
        $this->response['data'] = $result;
      }
      return $this->response();
    }

    public function getTotalMembers($id){
      $result = MessengerMember::where('messenger_group_id', '=', $id)->count();
      return $result;
    }
}
