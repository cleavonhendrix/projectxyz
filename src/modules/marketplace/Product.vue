<template>
  <div v-if="data !== null">
    <div class="title">
      <b @click="redirect('/marketplace')">
        <label class="text-primary action-link">Marketplace</label>
      </b>
      <label class="text-primary">/ {{data.title}}</label>
    </div>
    <div class="product-item-holder">
      <div class="product-image">
        <img :src="config.BACKEND_URL + selectedImage" class="main-image" v-if="selectedImage !== null">
        <img :src="config.BACKEND_URL + data.featured.url" class="main-image" v-if="selectedImage === null && data.featured !== null">
        <i class="fa fa-image" v-if="selectedImage === null && data.featured === null"></i>
       <div class="images-holder" v-if="data.images !== null">
        <div v-for="item, index in data.images" class="image-item" @click="selectImage(item.url)">
          <img :src="config.BACKEND_URL + item.url" class="other-image">
          <div class="overlay"></div>
        </div>
       </div>
      </div>
      <div class="product-details">
        <div class="product-title">
          <h3>{{data.title}}</h3>
        </div>
        <div class="product-row text-primary" v-if="data.price !== null">
          <label v-if="data.price.length === 1">PHP {{data.price[0].price}}</label>
          <label v-if="data.price.length > 1">PHP {{data.price[data.price.length - 1].price + ' - ' + data.price[0].price}}</label>
          <i class="fa fa-chevron-down show-prices" style="padding-left: 20px;" @click="showPrice(true)" v-if="data.price.length > 1 && priceFlag === false"></i>
          <i class="fa fa-chevron-up show-prices" style="padding-left: 20px;" @click="showPrice(false)" v-if="data.price.length > 1 && priceFlag === true"></i>
        </div>
        <div class="product-row" v-if="data.price.length > 1 && priceFlag === true">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td>Minimum</td>
                <td>Maximum</td>
                <td>Price</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item, index in data.price">
                <td>{{item.minimum}}</td>
                <td>{{item.maximum}}</td>
                <td>PHP {{item.price}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="product-row" v-if="data.color !== null">
          <label>COLOR</label>
          <span v-for="item, index in data.color" v-bind:style="{background: item.payload_value}" class="attribute"></span>
        </div>
        <div class="product-row" v-if="data.size !== null">
          <label>SIZE</label>
          <span class="attribute" v-for="item, index in data.size">{{item.payload_value}}</span>
        </div>
        <div class="product-row">
          <label>Quantity</label>
          <select class="qty-input" v-model="qty">
            <option v-for="i in 20">{{i}}</option>
          </select>
        </div>
        <div class="product-row" v-if="data.checkout_flag === true">
          <span class="alert bg-primary">
            This product was added to your cart. Proceed to checkout now!
          </span>
        </div>
        <div class="product-row">
          <button class="btn btn-primary" @click="addToCart(data.id)" v-if="data.checkout_flag === false"><i class="fa fa-shopping-cart" style="padding-right: 10px;"></i>ADD TO CART</button>
          <button class="btn btn-danger" @click="addToWishlist(data.id)" v-if="data.wishlist_flag === false && data.checkout_flag === false"><i class="far fa-heart" style="padding-right: 10px;"></i>ADD TO WISHLIST</button>
          <button class="btn btn-warning" @click="redirect('/checkout')" v-if="data.checkout_flag === true">PROCEED TO CHECKOUT</button>
        </div>
        <div class="product-row-rating" style="margin-top: 5px;">
          <ratings :payload="'product'" :payloadValue="data.id"></ratings>
        </div>
        <div class="product-row-tags" v-if="data.tags !== null && data.tag_array !== null">
          <label style="width: 15%;">Tags</label>
          <label class="tag-label" v-for="item, index in data.tag_array">{{item.title}}</label>
        </div>
      </div>
    </div>
    <div class="product-more-details">
      <div class="pagination-holder">
        <ul class="product-menu">
          <li v-for="item, index in productMenu" v-bind:class="{'menu-active': item.flag === true}" class="" @click="selectMenu(index)">{{item.title}}</li>
        </ul>
      </div>
      <div class="details-holder" v-if="prevMenuIndex === 0">
        <label>
          <label v-html="data.description"></label>
        </label>
      </div>
      <div class="details-holder" v-if="prevMenuIndex === 1">
        <label>Shippings</label>
      </div>
      <div class="details-holder" v-if="prevMenuIndex === 2">
        <product-comments :payloadValue="data.id" :payload="'product'"></product-comments>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .title{
    width: 100%;
    float: left;
    font-size: 16px;
  }
  .product-item-holder{
    width: 100%;
    float: left;
    min-height: 10px;
    overflow-y: hidden;
  }
  .product-image{
    width: 40%;
    float: left;
    min-height: 410px;
    overflow-y: hidden;
    text-align: center;
  }
  .product-image .main-image{
    height: 350px;
    float: left;
    width: 100%;
  }
  .product-image .fa-image{
    font-size: 250px;
    line-height: 350px;
  }
  .product-image .image-item{
    height: 60px;
    float: left;
    width: 80px;
  }
  .product-image .other-image{
    height: 60px;
    float: left;
    width: 80px;
  }
  .product-image .image-item:hover{
    cursor: pointer;
    background: #ffaa81;
  }
  .images-holder .overlay{
    height: 60px;
    z-index: 2;
    width: 80px;
    margin-top: -60px;
    float: left;
    background: rgba(0, 0, 0, 0.5);
  }
  .images-holder{
    width: 100%;
    float: left;
    min-height: 60px;
    overflow-y: hidden;
  }
  .product-details{
    min-height: 50px;
    width: 58%;
    margin-left: 2%;
    float: left;
    overflow-y: hidden;
  }
  .product-title{
    width: 100%;
    float: left;
    min-height: 50px;
    overflow-y: hidden;
    margin-top: 25px;
  }
  .product-row{
    width: 100%;
    float: left;
    min-height: 40px;
    overflow-y: hidden;
    font-weight: 600;
    font-size: 16px;
    line-height: 40px;
  }
  .product-row-tags{
    width: 100%;
    float: left;
    min-height: 40px;
    overflow-y: hidden;
    font-weight: 600;
    line-height: 40px;
  }
  .product-row-rating{
    width: 100%;
    float: left;
    min-height: 40px;
    overflow-y: hidden;
    font-size: 16px;
    line-height: 40px;
  }
  .product-row label{
    float: left;
    width: 15%;
  }
  .qty-input{
    width: 50px;
    height: 40px;
    float: left;
    border-radius: 5px;
    border: solid 1px #ffaa81;
    text-align: center !important;
  }
  .product-row-tags label{
    float: left;
  }
  .tag-label{
    height: 35px;
    line-height: 35px;
    background: #ffaa81;
    padding-left: 10px;
    padding-right: 10px;
    color: #fff;
    margin-right: 5px;
    border-radius: 5px;
    margin-top: 2px;
  }
  .attribute{
    width: 50px;
    height: 40px;
    float: left;
    border-radius: 5px;
    border: solid 1px #ffaa81;
    margin-right: 5px;
  }
  .attribute:hover{
    cursor: pointer;
  }
  .product-more-details{
    width: 100%;
    float: left;
    margin-bottom: 100px;
    min-height: 50px;
    overflow-y: hidden;
    border-top: solid 1px #ffaa81;
  }
  .product-more-details .details-holder{
    width: 60%;
    float: left;
    min-height: 10px;
    overflow-y: hidden;
    margin-top: 25px;
  }
  .product-menu{
    list-style: none;
    padding: 0px;
    margin: 0;
    width: 60%;
    margin-right: 40%;
    float: left;
    color: #fff;
  }
  .product-menu li{
    height: 50px;
    float: left;
    width: 25%;
    line-height: 50px;
    padding-left: 10px;
    font-weight: 600;
    border-right: solid 1px #fff;
    background: #ffaa81;
  }
  .product-menu li:hover{
    cursor: pointer;
    color: #000;
  }
  .menu-active{
    color: #000;
  }
  .show-prices:hover{
    cursor: pointer;
    color: #ffaa81;
  }
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  mounted(){
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      data: null,
      code: this.$route.params.code,
      productMenu: [
        {title: 'Product Details', flag: true},
        // {title: 'Supplier', flag: false},
        {title: 'Shippings', flag: false},
        {title: 'Reviews', flag: false}
      ],
      prevMenuIndex: 0,
      selectedImage: null,
      qty: 1,
      priceFlag: false
    }
  },
  components: {
    'ratings': require('modules/rating/Ratings.vue'),
    'product-comments': require('modules/comment/Comments.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    selectMenu(index){
      if(this.prevMenuIndex !== index){
        this.productMenu[this.prevMenuIndex].flag = false
        this.productMenu[index].flag = true
        this.prevMenuIndex = index
      }
    },
    selectImage(url){
      this.selectedImage = url
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: 'published',
          column: 'status',
          clause: '='
        }, {
          value: this.code,
          column: 'code',
          clause: '='
        }],
        account_id: this.user.userID
      }
      this.APIRequest('products/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data[0]
        }
      })
    },
    addToWishlist(id){
      let parameter = {
        payload: 'product',
        payload_value: id,
        account_id: this.user.userID
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('wishlists/create', parameter).then(response => {
        $('#loading').css({display: 'none'})
        this.retrieve()
      })
    },
    addToCart(id){
      let parameter = {
        account_id: this.user.userID,
        payload: 'product',
        payload_value: id,
        price: this.getPrice(),
        qty: this.qty,
        type: 'marketplace'
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('checkout_items/create', parameter).then(response => {
        $('#loading').css({display: 'none'})
        if(response.data > 0){
          AUTH.checkAuthentication(null)
          this.retrieve()
        }
      })
    },
    showPrice(flag){
      this.priceFlag = flag
    },
    getPrice(){
      let price = this.data.price
      if(price.length > 0){
        // variable
        for (var i = 0; i < price.length; i++) {
          if(this.qty >= price[i].minimum && this.qty <= price[i].maximum){
            return price[i].price
          }
        }
        if(this.qty > price[price.length - 1].maximum){
          return price[price.length - 1].maximum
        }
      }else if(price.length === 1){
        if(price[0].type === 'fixed'){
          return price[0].price
        }
      }
      return 0
    }
  }
}
</script>
