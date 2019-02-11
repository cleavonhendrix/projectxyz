<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;
use App\StripeCard;
use Carbon\Carbon;
class PaymentMethodController extends ClassWorxController
{
    function __construct(){
    	$this->model = new PaymentMethod();
    }

    public function retrieve(Request $request){
    	$data = $request->all();
    	$accountId = $data['account_id'];
    	$result = PaymentMethod::where('account_id', '=', $accountId)->get();
      if(sizeof($result) > 0){
      	$i = 0;
      	foreach ($result as $key) {
      		$payload = $result[$i]['payload'];
	        $payloadValue = $result[$i]['payload_value'];
	        $result[$i]['stripe'] = null;
	        $result[$i]['paypal'] = null;
	        if($payload == 'credit_card'){
	          // stripe
	          $cards = StripeCard::where('id', '=', $payloadValue)->first();
	          $result[$i]['stripe'] = ($cards) ? $cards : null;
	        }else if($payload == 'paypal'){
	          // paypal
	        }else if($payload == 'cod'){
	          // cod
	        }else{
	        	//
	        }
	        $i++;
      	}
      	return response()->json(array(
      		'data'	=> $result,
      		'error' => null,
      		'timestamps' => Carbon::now()
      	));
      }
    	return response()->json(array(
    		'data'	=> null,
    		'error' => null,
    		'timestamps' => Carbon::now()
    	));
    }

    public function update(Request $request){
    	$data = $request->all();
    	$accountId = $data['account_id'];
    	$id = $data['id'];
    	$result = PaymentMethod::where('account_id', '=', $accountId)->where('status', '=', 'active')->first();
    	if($result){
    		PaymentMethod::where('id', '=', $result->id)->update(
    			array(
    				'status'	=> 'inactive',
    				'updated_at' => Carbon::now()
    			)
    		);
    	}
  	  PaymentMethod::where('id', '=', $id)->update(
  			array(
  				'status'	=> 'active',
  				'updated_at' => Carbon::now()
  			)
  		);
  		return response()->json(array(
    		'data'	=> true,
    		'error' => null,
    		'timestamps' => Carbon::now()
    	));
    }
}
