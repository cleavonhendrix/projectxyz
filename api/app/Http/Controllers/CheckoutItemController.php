<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckoutItem;
use App\Checkout;
use App\Account;
class CheckoutItemController extends ClassWorxController
{
    function __construct(){
    	$this->model = new CheckoutItem();
    }

    public function create(Request $request){
    	$data = $request->all();
      $insertData = array(
        'account_id' => $data['account_id'],
        'payload' => $data['payload'],
        'payload_value' => $data['payload_value'],
        'price' => $data['price'],
        'qty' => $data['qty'],
        'status' => 'printing'
      );
    	$accountId = $data['account_id'];
    	$checkout = Checkout::where('account_id', '=', $accountId)->where('status', '=', 'added')->first();
    	if($checkout){
    		$insertData['checkout_id'] = $checkout->id;
    		$this->model = new CheckoutItem();
    		$this->insertDB($insertData);
    		return $this->response();
    	}else{
    		$checkout = new Checkout();
        $checkout->payload = $data['type'];
    		$checkout->account_id = $data['account_id'];
        $checkout->order_number = $this->getOrderNumber($data['account_id']);
    		$checkout->sub_total = 0;
    		$checkout->tax = 0;
    		$checkout->total = 0;
    		$checkout->status = 'added';
        $checkout->printing_status = 'added';
    		$checkout->save();
    		if($checkout->id){
    			$insertData['checkout_id'] = $checkout->id;
	    		$this->model = new CheckoutItem();
	    		$this->insertDB($insertData);
	    		return $this->response();
    		}else{
		    	return response()->json(array(
		    		'data'	=> null,
		    		'error' => null,
		    		'timestamps' => Carbon::now()
		    	));
    		}
    	}
    }
    
    public function getOrderNumber($accountId){
      $orderSuffix = 'CWO-';
      $checkouts = Checkout::where('account_id', '=', $accountId)->count();
      if($checkouts){
        if($checkouts >= 1000){
          return $orderSuffix.($checkouts + 1);
        }else if($checkouts >= 100){
          return $orderSuffix.'0'.($checkouts + 1);
        }else if($checkouts >= 10){
          return $orderSuffix.'00'.($checkouts + 1);
        }else if($checkouts >= 0){
          return $orderSuffix.'000'.($checkouts + 1);
        }
      }else{
        return $orderSuffix.'0001';
      }
    }
}
