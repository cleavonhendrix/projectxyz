<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Checkout;
use App\CheckoutItem;
use App\StripeCard;
use App\PaymentMethod;
use App\Product;
use App\ProductPrice;
use App\PaypalTransaction;
use App\StripeWebhook;
use Carbon\Carbon;
class CheckoutController extends ClassWorxController
{
    protected $subTotal = 0;
    protected $total = 0;
    protected $tax = 0;

    function __construct(){
    	$this->model = new Checkout();

      $this->notRequired = array(
        'coupon_id',
        'order_number',
        'payment_type',
        'payment_payload',
        'payment_payload_value'
      );
    }

    public function retrieve(Request $request){
      $data = $request->all();
      $this->retrieveDB($data);
      $result = $this->response['data'];
      $cards = $this->getPaymentMethod('account_id', $data['account_id']);
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $price = $this->getPrice($result[$i], $data['account_id']);
          $this->response['data'][$i]['partner_details'] = ($result[$i]['partner'] != null && $result[$i]['partner'] != '' && $result[$i]['partner'] > 0) ? $this->retrieveAccountDetails($result[$i]['partner']) : null;
          $this->response['data'][$i]['items'] = $this->getItems($result[$i]['id'], $price, $data['account_id']);
          $this->response['data'][$i]['sub_total'] = $this->subTotal;
          $this->response['data'][$i]['tax'] = $this->tax;
          $this->response['data'][$i]['total'] = $this->subTotal - $this->tax;
          if($result[$i]['payment_type'] == 'authorized' && $result[$i]['payment_payload'] == 'credit_card'){
            $this->response['data'][$i]['method'] = $this->getPaymentMethod('id', $result[$i]['payment_payload_value']);
          }else{
            $this->response['data'][$i]['method'] = null;
          }
          $i++;
        }
      }
      
      $this->response['method'] = $cards;
      return $this->response();
    }

    public function retrieveOrderItems(Request $request){
      $data = $request->all();
      $this->retrieveDB($data);
      $result = $this->response['data'];
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $this->response['data'][$i]['items'] = $this->getOrderItems($result[$i]['id']);
          $i++;
        }
      }
      
      return $this->response();
    }

    public function getItems($checkoutId, $price, $accountId){
      $result = CheckoutItem::where('checkout_id', '=', $checkoutId)->get();
      $this->subTotal = 0;
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $payload = $result[$i]['payload'];
          $payloadValue = $result[$i]['payload_value'];
          if($payload == 'product'){
            $this->subTotal += floatval($result[$i]['price']) * floatval($result[$i]['qty']);
            $result[$i]['product'] = app('App\Http\Controllers\ProductController')->retrieveProductById($payloadValue, $accountId);  
          }
          $i++;
        }
        return $result;
      }else{
        return null;
      }
    }

    public function updateByColumn(Request $request){
      $data = $request->all();
      $this->model = new Checkout();
      $this->updateDB($data);
      return $this->response();
    }

    public function update(Request $request){
      $data = $request->all();
      $accountId = $data['account_id'];
      $id = $data['id'];
      $tax = $data['tax'];
      $subTotal = $data['sub_total'];
      $total = $data['total'];
      $paymentType = $data['payment_type'];
      $couponId = $data['coupon_id'];
      $discount = $data['discount'];
      $paymentPayload = $data['payment_payload'];
      $paymentPayloadValue = $data['payment_payload_value'];
      $email = $data['email'];
      $title = 'Charge for order number'.$data['order_number'];

      $updateData = array(
        'id'  => $id,
        'tax' => $tax,
        'sub_total' => $subTotal,
        'total' => $total,
        'discount'  => $discount,
        'payment_type' => $paymentType,
        'payment_payload' => $paymentPayload,
        'status'  => 'completed',
        'updated_at'  => Carbon::now()
      );

      if($couponId != '' && $couponId != null){
        $updateData['coupon_id'] = $couponId;
      }

      if(($paymentType == 'authorized' || $paymentType == 'express') && $paymentPayload == 'credit_card'){
        $paymentMethod = $this->getPaymentMethod('id', $paymentPayloadValue);
        $updateData['payment_payload_value'] = $paymentPayloadValue;
        $charge = null;
        if($paymentMethod->payload == 'credit_card'){
          $stripe = new StripeWebhook();
          $charge = $stripe->chargeCustomer($email, $paymentMethod->stripe->source, $paymentMethod->stripe->customer, $total, $title);
        }

        if($charge && $charge->status == 'succeeded'){
          $this->model = new Checkout();
          $this->updateDB($updateData);
          return $this->response();
        }else{
          return response()->json(array(
            'data'  => false,
            'error' => 'Unable to charge',
            'timestamps'  => Carbon::now()
          ));
        }
      }else if($paymentType == 'express' && $paymentPayload == 'paypal'){
        $payerInfo = $paymentPayloadValue['payer']['payer_info'];
        $paypal = new PaypalTransaction();
        $paypal->account_id = $accountId;
        $paypal->paypal = $paymentPayloadValue['id'];
        $paypal->cart = $paymentPayloadValue['cart'];
        $paypal->email = $payerInfo['email'];
        $paypal->first_name = $payerInfo['first_name'];
        $paypal->middle_name = $payerInfo['middle_name'];
        $paypal->last_name = $payerInfo['last_name'];
        $paypal->payer = $payerInfo['payer_id'];
        $paypal->total = $total;
        $paypal->currency = 'PHP';
        $paypal->save();

        if($paypal->id){
          $updateData['payment_payload_value'] = $paypal->id;
          $this->model = new Checkout();
          $this->updateDB($updateData);
          return $this->response();
        }else{
          return response()->json(array(
            'data'  => false,
            'error' => 'Unable to charge',
            'timestamps'  => Carbon::now()
          ));
        }
      }else{
          return response()->json(array(
            'data'  => false,
            'error' => 'Unable to charge',
            'timestamps'  => Carbon::now()
          ));
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
