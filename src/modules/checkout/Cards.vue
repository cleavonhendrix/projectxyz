<template>
  <div class="sidebar">
    <span class="title">Order Summary</span>
    <span class="bg-danger printing-hint" v-if="item.partner_details === null">
      Kindly assign your checkout to our printing partner by clicking the + icon below using the company code.  
    </span>
    <span class="item" v-if="item.partner_details !== null">
      <label>Subtotal</label>
      <label class="pull-right" style="padding-right: 10px;">PHP {{item.sub_total}}</label>
    </span>
    <span class="item" v-if="item.partner_details !== null">
      <label>Tax</label>
      <label class="pull-right" style="padding-right: 10px;">PHP {{item.tax}}</label>
    </span>
    <span class="item" style="border-bottom: 0px;" v-if="item.payload !== 'direct'">
      <label class="text-primary">
        <label v-if="item.partner_details === null"><b>Assign</b></label>
        <label v-if="item.partner_details !== null"><b>Assigned</b></label>
        <b>Printing</b> <b v-if="item.partner_details !== null">{{' to ' + item.partner_details.username}}</b>
      </label>
      <i @click="clearPartner()" class="fa fa-trash text-danger pull-right" style="line-height: 50px; font-size: 20px;padding-right: 10px;" v-if="item.partner_details !== null"></i>
      <i @click="applyPartner()" class="fa fa-plus text-primary pull-right" style="line-height: 50px; font-size: 20px;padding-right: 10px;" v-else></i>
    </span>
    <span class="item" style="border-bottom: 0px;" v-if="item.partner_details !== null">
      <label class="text-primary">
        <b>Promo Code</b>: <b v-if="coupon !== null">{{coupon.code.toUpperCase()}}</b>
        <b v-if="coupon !== null && coupon.type === 'percentage'"> (-{{coupon.value}}%)</b>
        <b v-if="coupon !== null && coupon.type === 'fixed_amount'"> (-{{coupon.value}})</b>
      </label>
      <i @click="clearCoupon()" class="fa fa-trash text-danger pull-right" style="line-height: 50px; font-size: 20px;padding-right: 10px;" v-if="coupon !== null"></i>
      <i @click="applyCoupon()" class="fa fa-plus text-primary pull-right" style="line-height: 50px; font-size: 20px;padding-right: 10px;" v-else></i>
    </span>
    <span class="item" style="border-bottom: 0px;" v-if="item.partner_details !== null">
      <label><b>Total</b></label>
      <label class="pull-right" style="padding-right: 10px;"><b>PHP {{item.total}}</b></label>
    </span>
    <span class="item" style="border-bottom: 0px;" v-if="method !== null && method.stripe !== null && item.partner_details !== null">
      <label>Active Payment Method</label>
      
      <label class="pull-right" style="padding-right: 10px;">******** {{method.stripe.last4}} <i class="fa fa-edit text-danger" @click="redirect('/profile/payment_method')"></i></label>
    </span>
    <span class="item" style="border-bottom: 0px;" v-if="method !== null && method.paypal !== null && item.partner_details !== null">
      <label>Active Payment Method</label>
      
      <label class="pull-right" style="padding-right: 10px;"> {{method.paypal.nickname}} <i class="fa fa-edit text-danger" @click="redirect('/profile/payment_method')"></i></label>
    </span>

    <span class="item" style="border-bottom: 0px;" v-if="method !== null && method.payload === 'cod'">
      <label>Active Payment Method</label>
      
      <label class="pull-right" style="padding-right: 10px;"> {{method.payload_value}} <i class="fa fa-edit text-danger" @click="redirect('/profile/payment_method')"></i></label>
    </span>
    <span class="custom-btn" style="border-bottom: 0px;" v-if="item.partner_details !== null">
        <PayPal
          v-bind:amount="'' + item.total"
          currency="PHP"
          :client="paypal"
          :button-style="myStyle"
          env="sandbox"
          @payment-completed="paypalCompleted($event)"
          @payment-cancelled="paypalCancelled($event)"
          @payment-authorized="paypalAuthorized($event)">
        </PayPal>
    </span>
    <button class="btn btn-primary custom-btn" @click="creditCard()" v-if="item.partner_details !== null"><i class="fa fa-credit-card"></i> Credit Card</button>
    <button class="btn btn-primary custom-btn" @click="redirect('/profile/payment_method')" v-if="method === null && item.partner_details !== null">Authorized Payment using Credit Card</button>
    <!-- <button class="btn btn-warning custom-btn" @click="updateStripeAuthorized()"> Complete Purchase</button> -->
    
    <cancelled-paypal></cancelled-paypal>
    <express-credit-card></express-credit-card>
    <apply-coupon></apply-coupon>
    <apply-partner></apply-partner>
  </div>
</template>
<style scoped>
.sidebar{
  width: 100%;
  float: left;
}
.sidebar .title, .sidebar .item{
  height: 50px;
  width: 100%;
  float: left;
  line-height: 50px;
  border-bottom: solid 1px #eee;
  padding-left: 10px;
}
.sidebar .title{
  font-size: 24px;
  border-bottom: 0px;
  background: #22b173;
  color: #fff;
}
.custom-btn{
  margin-top: 10px !important; 
  width: 100% !important;
  height: 50px !important;
}
.fa-edit{
  font-size: 24px;
  line-height: 50px;
  float: left;
}
.delete:hover{
  cursor: pointer;
}
.fa-edit:hover{
  cursor: pointer;
  color: #22b173;
}
.printing-hint{
  width: 100%;
  float: left;
  min-height: 50px;
  margin-top: 10px;
  overflow-y: hidden;
  padding: 10px;
  color: #fff;
  text-align: justify;
  border-radius: 5px;
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
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      partner: null,
      coupon: null,
      discount: null,
      paypal: {
        sandbox: 'Ad3i7TApZLrGnTTF_BWrXZYFlz1sDUMRjWGeGn6ED8POGj1gp6Z43n4ph31ASUqlPtZguFqR7KMp2ZqH',
        production: 'Ad3i7TApZLrGnTTF_BWrXZYFlz1sDUMRjWGeGn6ED8POGj1gp6Z43n4ph31ASUqlPtZguFqR7KMp2ZqH'
      },
      credentials: {
        sandbox: 'Ad3i7TApZLrGnTTF_BWrXZYFlz1sDUMRjWGeGn6ED8POGj1gp6Z43n4ph31ASUqlPtZguFqR7KMp2ZqH',
        production: 'Ad3i7TApZLrGnTTF_BWrXZYFlz1sDUMRjWGeGn6ED8POGj1gp6Z43n4ph31ASUqlPtZguFqR7KMp2ZqH'
      },
      myStyle: {
        label: 'checkout',
        size: 'responsive',
        shape: 'pill',
        color: 'gold'
      },
      success: null
    }
  },
  props: ['item', 'method'],
  components: {
    'cancelled-paypal': require('modules/checkout/CancelPaypal.vue'),
    'express-credit-card': require('modules/checkout/CreditCard.vue'),
    'apply-coupon': require('modules/coupon/Apply.vue'),
    'apply-partner': require('modules/checkout/Partner.vue'),
    PayPal
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    updateStripeAuthorized(){
      if(this.data !== null){
        let parameter = {
          id: this.item.id,
          payment_type: 'authorized',
          payment_payload: 'credit_card',
          payment_payload_value: this.method.id,
          sub_total: this.item.sub_total,
          total: this.item.total,
          tax: this.item.tax,
          account_id: this.user.userID,
          email: this.user.email,
          order_number: this.item.order_number
        }
        this.updateRequest(parameter)
      }
    },
    updateStripeExpress(id){
      if(this.data !== null){
        let parameter = {
          id: this.item.id,
          payment_type: 'express',
          payment_payload: 'credit_card',
          payment_payload_value: id,
          sub_total: this.item.sub_total,
          total: this.item.total,
          tax: this.item.tax,
          discount: (this.coupon !== null) ? this.discount : 0,
          coupon_id: (this.coupon !== null) ? this.coupon.id : null,
          account_id: this.user.userID,
          email: this.user.email,
          order_number: this.item.order_number
        }
        this.updateRequest(parameter)
      }
    },
    initPaypal(){
    },
    paypalCompleted(data){
      if(data.state === 'approved'){
        let parameter = {
          id: this.item.id,
          payment_type: 'express',
          payment_payload: 'paypal',
          payment_payload_value: data,
          sub_total: this.item.sub_total,
          total: this.item.total,
          tax: this.item.tax,
          discount: (this.coupon !== null) ? this.discount : 0,
          coupon_id: (this.coupon !== null) ? this.coupon.id : null,
          account_id: this.user.userID,
          email: this.user.email,
          order_number: this.item.order_number
        }
        this.updateRequest(parameter)
      }
    },
    paypalCancelled(data){
      $('#cancelPaypalModal').modal('show')
    },
    paypalAuthorized(data){
    },
    updateRequest(parameter){
      this.APIRequest('checkouts/update', parameter).then(response => {
        if(response.data === true){
          AUTH.checkAuthentication(null)
          ROUTER.push('/thankyou/' + this.item.order_number)
        }
      })
    },
    creditCard(){
      $('#creditCardModal').modal('show')
    },
    applyCoupon(){
      $('#applyCouponModal').modal('show')
    },
    clearCoupon(){
      this.coupon = null
      this.$parent.retrieve()
    },
    applyPartner(){
      $('#applyPartnerModal').modal('show')
    },
    clearPartner(){
      let parameter = {
        id: this.item.id
      }
      this.APIRequest('checkouts/update_remove_partner', parameter).then(response => {
        if(response.data === true){
          this.$parent.retrieve()
        }
      })
    },
    managePartner(){
      let parameter = {
        id: this.item.id,
        partner: this.partner.id
      }
      this.APIRequest('checkouts/update_status', parameter).then(response => {
        if(response.data === true){
          $('#applyPartnerModal').modal('hide')
          this.$parent.retrieve()
        }
      })
    },
    manageCoupon(){
      if(this.coupon !== null){
        if(this.coupon.type === 'percentage'){
          this.discount = (parseFloat(this.coupon.value) / 100) * this.item.total
        }else if(this.coupon.type === 'fixed_amount'){
          this.discount = parseFloat(this.coupon.value)
        }
        this.item.total -= this.discount
      }
    }
  }
}
</script>
