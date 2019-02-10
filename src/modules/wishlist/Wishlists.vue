<template>
  <div class="holder">
    <span class="list" v-if="data !== null">
      <span class="items">
        <span class="title">
          <b>Your Items</b>
        </span>
        <span class="item" v-for="item, index in data" >
          <span class="objects-holder-full" v-if="item.payload === 'product' && item.product !== null">
            <product :data="item" :route="'checkout_items'"></product>
          </span>
        </span>
      </span>
      <span class="sidebar pull-right">
      </span>
    </span>
    <checkout-empty v-if="data === null || data[0].items === null" :title="'You don\'t have items on your wishlist yet!'" :action="'Start adding items now!'" :icon="'far fa-smile'" :iconColor="'text-primary'"></checkout-empty>
  </div>
</template>
<style scoped>
.holder{
  width: 98%;
  float: left;
  margin-right: 2%;
  margin-top: 25px;
}
.list{
  width: 100%;
  float: left;
  margin-top: 25px;
}
.items{
  width: 70%;
  float: left;
  min-height: 50px;
  overflow-y: hidden;
}
.items .title{
  height: 50px;
  width: 100%;
  float: left;
  line-height: 50px;
  padding-left: 10px;
  font-size: 24px;
  border-bottom: solid 1px #eee;
  color: #22b173;
}
.items .item{
  width: 100%;
  float: left;
  min-height: 100px;
  overflow-y: hidden;
  border-bottom: solid 1px #eee;
}
.objects-holder-full{
  float: left;
  width: 100%;
  height: 150px;
}
.objects-holder{
  float: left;
}
.details{
  float: left;
  width: 70%;
}
.two-objects-holder{
  float: left;
  width: 80%;
}
.two-details{
  float: left;
  width: 40%;
}
.details label, .two-details label{
  width: 100%;
  float: left;
}
.sidebar{
  width: 30%;
  float: left;
  min-height: 50px;
  overflow-y: hidden;
}

</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
import PayPal from 'vue-paypal-checkout'
export default {
  mounted(){
    AUTH.checkPlan()
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      data: null
    }
  },
  components: {
    'product': require('modules/wishlist/Item.vue'),
    'checkout-empty': require('modules/empty/EmptyDynamicIcon.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: this.user.userID,
          column: 'account_id',
          clause: '='
        }],
        account_id: this.user.userID
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('wishlists/retrieve', parameter).then(response => {
        $('#loading').css({display: 'none'})
        if(response.data.length > 0){
          this.data = response.data
          this.method = response.method
          this.initPaypal()
        }else{
          this.data = null
        }
      })
    },
    remove(id){
      let parameter = {
        id: id
      }
      this.APIRequest('wishlists/delete', parameter).then(response => {
        AUTH.checkAuthentication(null)
        this.retrieve()
      })
    }
  }
}
</script>

