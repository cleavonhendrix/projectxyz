<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;

class WishlistController extends APIController
{
    function __construct(){
    	$this->model = new Wishlist();
    }

    public function retrieve(Request $request){
    	$data = $request->all();
    	$accountId = $data['account_id'];
    	$this->model = new Wishlist();
    	$this->retrieveDB($data);
    	$result = $this->response['data'];
    	if(sizeof($result) > 0){
    		$i = 0;
    		foreach ($result as $key) {
    			$payloadValue = $result[$i]['payload_value'];
    			if($result[$i]['payload'] == 'product'){
    				$this->response['data'][$i]['product'] = app('App\Http\Controllers\ProductController')->retrieveProductById($payloadValue, $accountId);
    			}
    			$i++;
    		}
    		return $this->response();
    	}
    	return $this->response();
    }
}
