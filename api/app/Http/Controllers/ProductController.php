<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductPhoto;
use App\ProductPrice;
use App\Checkout;
use App\CheckoutItem;
use App\Wishlist;
class ProductController extends ClassWorxController
{
    function __construct(){
      $this->model = new Product();
      $this->notRequired = array('description');
    }
    public function create(Request $request){
      $data = $request->all();
      $data['code'] = $this->generateCode();
      $this->model = new Product();
      $this->insertDB($data);
      return $this->response();
    }

    public function generateCode(){
      $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
      $codeExist = Product::where('id', '=', $code)->get();
      if(sizeof($codeExist) > 0){
        $this->generateCode();
      }else{
        return $code;
      }
    }

    public function retrieve(Request $request){
      $data = $request->all();
      $accountId = $data['account_id'];
      $this->model = new Product();
      $this->retrieveDB($data);
      $result = $this->response['data'];
      // details
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $this->response['data'][$i]['account'] = $this->retrieveAccountDetails($result[$i]['account_id']);
          $this->response['data'][$i]['price'] = $this->getPrice($result[$i]['id']);
          $this->response['data'][$i]['color'] = $this->getColor($result[$i]['id']);
          $this->response['data'][$i]['size'] = $this->getSize($result[$i]['id']);
          $this->response['data'][$i]['featured'] = $this->getFeaturedImage($result[$i]['id']);
          $this->response['data'][$i]['images'] = $this->getImages($result[$i]['id']);
          $this->response['data'][$i]['tag_array'] = $this->manageTags($result[$i]['tags']);
          $this->response['data'][$i]['wishlist_flag'] = $this->checkWishlist($result[$i]['id'], $accountId);
          $this->response['data'][$i]['checkout_flag'] = $this->checkCheckout($result[$i]['id'], $accountId);
          $i++;
        }
      }
      return $this->response();
    }

    public function retrieveProductById($id, $accountId){
      $data = array(
        'condition' => array(array(
          'value'   => $id,
          'column'  => 'id',
          'clause'  => '='
        ))
      );

      $this->model = new Product();
      $this->retrieveDB($data);
      $result = $this->response['data'];
      // details
      if(sizeof($result) > 0){
        $i = 0;
        foreach ($result as $key) {
          $result[$i]['account'] = $this->retrieveAccountDetails($result[$i]['account_id']);
          $result[$i]['price'] = $this->getPrice($result[$i]['id']);
          $result[$i]['color'] = $this->getColor($result[$i]['id']);
          $result[$i]['size'] = $this->getSize($result[$i]['id']);
          $result[$i]['featured'] = $this->getFeaturedImage($result[$i]['id']);
          $result[$i]['images'] = $this->getImages($result[$i]['id']);
          $result[$i]['tag_array'] = $this->manageTags($result[$i]['tags']);
          $result[$i]['wishlist_flag'] = $this->checkWishlist($result[$i]['id'], $accountId);
          $result[$i]['checkout_flag'] = $this->checkCheckout($result[$i]['id'], $accountId);
          $i++;
        }
      }
      return (sizeof($result) > 0) ? $result[0] : null;
    }

    public function manageTags($tags){
      $result = array();
      if($tags != null){
        if(strpos($tags, '#')){
            $array  = explode('#', $tags);
            if(sizeof($array) > 0){
              for ($i=0; $i < sizeof($array) - 1; $i++) { 
                $resultArray = array(
                  'title' => $array[$i]
                );
                $result[] = $resultArray;
              }
              return $result;
            }else{
              return null;
            }
        }else{
        }
      }else{
        return null;
      }
    }

    public function getPrice($id){
      $result = ProductPrice::where('product_id', '=', $id)->orderBy('minimum', 'asc')->get();
      return (sizeof($result) > 0) ? $result : null;
    }

   public function checkWishlist($id, $accountId){
      $result = Wishlist::where('payload_value', '=', $id)->where('payload', '=', 'product')->where('account_id', '=', $accountId)->get();
      return (sizeof($result) > 0) ? true : false;
    }

    public function checkCheckout($id, $accountId){
      $result = Checkout::where('account_id', '=', $accountId)->where('status', '=', 'added')->get();
      if(sizeof($result) > 0){
        $itemResult = CheckoutItem::where('checkout_id', '=', $result[0]['id'])->where('payload', '=', 'product')->where('payload_value', '=', $id)->get();
        return (sizeof($itemResult) > 0) ? true : false;
      }else{
        return false;
      }
    }

    public function getColor($id){
      $result = ProductAttribute::where('product_id', '=', $id)->where('attribute', '=', 'color')->get();
      return (sizeof($result) > 0) ? $result : null;
    }

    public function getSize($id){
      $result = ProductAttribute::where('product_id', '=', $id)->where('attribute', '=', 'size')->get();
      return (sizeof($result) > 0) ? $result : null;
    }

    public function getImages($id){
      $result = ProductPhoto::where('product_id', '=', $id)->where('status', '=', 'others')->get();
      return (sizeof($result) > 0) ? $result : null;
    }

    public function getFeaturedImage($id){
      $result = ProductPhoto::where('product_id', '=', $id)->where('status', '=', 'featured')->get();
      return (sizeof($result) > 0) ? $result : null;
    }
}
