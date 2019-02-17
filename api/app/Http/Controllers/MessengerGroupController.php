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


    public function createNewIssue(Request $request){
      $data = $request->all();

      $creator = intval($data['creator']);
      $message = $data['message'];
      $this->model = new MessengerGroup();
      $insertData = array(
        'account_id'  => $creator,
        'title' => 'NONE',
        'payload' => 'support'
      );
      $this->insertDB($insertData);
      $id = intval($this->response['data']);
      if($id > 0){
        $member = new MessengerMember();
        $member->messenger_group_id = $id;
        $member->account_id = $creator;
        $member->status = 'admin';
        $member->created_at = Carbon::now();
        $member->save();

        $messageModel = new MessengerMessage();
        $messageModel->messenger_group_id = $id;
        $messageModel->account_id = $creator;
        $messageModel->message = $message;
        $messageModel->created_at = Carbon::now();
        $messageModel->save();

        return response()->json(array(
          'data'  => $id,
          'error' => null,
          'timestamps'  => Carbon::now()
        ));
      }else{
        return response()->json(array(
          'data'  => null,
          'error' => null,
          'timestamps'  => Carbon::now()
        ));
      }
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

    public function retrieveMyIssue(Request $request){
      $data = $request->all();
      $this->model = new MessengerGroup();
      $this->retrieveDB($data);

      $result = $this->response['data'];
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $this->response['data'][$i]['last_message'] = $this->getLastMessageSupport($result[$i]['id']);
          $i++;
        }
      }

      return $this->response();
    }

    public function getLastMessageSupport($messengerGroupId){
      $message = MessengerMessage::where('messenger_group_id', '=', $messengerGroupId)->orderBy('created_at', 'desc')->get();
      if(sizeof($message) > 0){
        $message[0]['account'] = $this->retrieveAccountDetails($message[0]['account_id']);
        $message[0]['created_at_human'] = Carbon::createFromFormat('Y-m-d H:i:s', $message[0]['created_at'])->copy()->tz('Asia/Manila')->format('F j, Y');
        return $message[0];
      }
      return null;
    }
}
