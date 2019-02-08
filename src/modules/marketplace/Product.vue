<template>
  <div>
    <div class="title">
      <b @click="redirect('/marketplace')">
        <label class="text-primary action-link">Marketplace</label>
      </b>
      <label class="text-primary">/ {{code}}</label>
    </div>
    <div class="product-item-holder">
      <div class="product-image">
        <img :src="selectedImage" class="main-image">
       <div class="images-holder">
        <div v-for="i in 5" class="image-item" @click="selectImage('../../assets/img/devices.png')">
          <img :src="selectedImage" class="other-image">
          <div class="overlay"></div>
        </div>
       </div>
      </div>
      <div class="product-details">
        <div class="product-title">
          <h3>Sample Product</h3>
        </div>
        <div class="product-row text-primary">
          <label>PHP 100</label>
        </div>
        <div class="product-row">
          <label>COLOR</label>
          <span class="attribute" v-for="i in 5"></span>
        </div>
        <div class="product-row">
          <label>SIZE</label>
          <span class="attribute" v-for="i in 5"></span>
        </div>
        <div class="product-row">
          <label>Quantity</label>
          <select class="qty-input">
            <option v-for="i in 20">{{i}}</option>
          </select>
        </div>
        <div class="product-row">
          <button class="btn btn-primary"><i class="fa fa-shopping-cart" style="padding-right: 10px;"></i>ADD TO CART</button>
        </div>
        <div class="product-row-rating" style="margin-top: 5px;">
          <ratings :payload="'product'" :payloadValue="1"></ratings>
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
        <label>Product Details</label>
      </div>
      <div class="details-holder" v-if="prevMenuIndex === 1">
        <label>Shippings</label>
      </div>
      <div class="details-holder" v-if="prevMenuIndex === 2">
        <product-comments :payloadValue="1" :payload="'product'"></product-comments>
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
  }
  .product-image .main-image{
    height: 350px;
    float: left;
    width: 100%;
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
    height: 50px;
    width: 58%;
    margin-left: 2%;
    float: left;
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
    width: 33%;
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
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  mounted(){
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
        {title: 'Shippings', flag: false},
        {title: 'Comments', flag: false}
      ],
      prevMenuIndex: 0,
      selectedImage: '../../assets/img/devices.png'
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
    }
  }
}
</script>
