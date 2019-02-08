<template>
  <div>
    <div class="product-holder" v-for="i in 20" @click="redirect('marketplace/product/12312312')">
      <div class="product-image">
       <img src="../../assets/img/devices.png">
      </div>
      <div class="product-details">
        <div class="product-title">
          <label style="padding-top: 5px;"><b>Sample Product</b></label>
          <label>Best for sample product</label>
        </div>
        <div class="product-price">
          PHP 100
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .product-holder{
    width: 24%;
    float: left;
    height: 300px;
    margin-right: 1%;
    border: solid 1px #ddd;
    margin-bottom: 10px;
    color: #555;
    margin-top: 25px;
  }
  .product-holder:hover{
    cursor: pointer;
    border: solid 1px #ffaa81;
    background: #ffaa81;
    color: #fff;
  }
  .product-image{
    width: 100%;
    float: left;
    height: 250px;
  }

  .product-image img{
    height: 250px;
    float: left;
    width: 100%;
  }
  .product-details{
    height: 50px;
    width: 100%;
    float: left;
    border-top: solid 1px #ddd;
  }
  .product-title{
    width: 75%;
    float: left;
    height: 50px;
  }
  .product-title label{
    width: 100%;
    float: left;
    font-size: 12px;
    margin: 0px !important;
    padding-left: 10px;
  }
  .product-price{
    width: 25%;
    float: left;
    height: 50px;
    line-height: 50px;
    font-weight: 600;
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
      categoryValue: null,
      searchValue: null
    }
  },
  components: {
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    }
  }
}
</script>
