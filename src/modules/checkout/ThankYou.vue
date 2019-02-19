<template>
	<div class="holder" v-if="data !== null">
		<span class="thank-you-header">
			<h1 style="line-height: 125px;">Thank you for your order, {{user.username}}!</h1>
			<label><b>Order # {{data.order_number}}</b></label>
			<label>We've sent an email for your receipt and payment notification at {{user.email}}.</label>
		</span>
		<span class="thank-you-item">
			<label><b>Summary</b></label>
		</span>
		<span class="thank-you-item">
			<label><b>Products</b></label>
			<label><b>Quantity</b></label>
			<label><b>Price</b></label>
		</span>
		<span class="thank-you-item" v-if="data.templates !== null" v-for="item, index in data.templates">
			<label>Template: {{item.template.title}}</label>
			<label>1</label>
			<label>{{item.price}}</label>
		</span>
		<span class="thank-you-item"  v-if="data.employees !== null">
			<label>ID's</label>
			<label>{{data.employees.length}}</label>
			<label>100</label>
		</span>
		<span class="thank-you-item">
			<label></label>
			<label>Subtotal</label>
      <label class="pull-right" style="padding-right: 10px;">PHP {{data.sub_total}}</label>
		</span>
		<span class="thank-you-item">
			<label></label>
			<label>Tax</label>
      <label class="pull-right" style="padding-right: 10px;">PHP {{data.tax}}</label>
		</span>
		<span class="thank-you-item" v-if="data !== null && data.coupon !== null">
		 	<label></label>
      <label class="text-primary">
        <b>Promo Code</b>: <b v-if="data.coupon !== null">{{data.coupon.code.toUpperCase()}}</b>
        <b v-if="data.coupon !== null && data.coupon.type === 'percentage'"> (-{{data.coupon.value}}%)</b>
        <b v-if="data.coupon !== null && data.coupon.type === 'fixed_amount'"> (-{{data.coupon.value}})</b>
      </label>
      <label class="pull-right">
      	PHP {{data.discount}}
      </label>
    </span>
		<span class="thank-you-item">
			<label></label>
			<label><b>Total</b></label>
      <label class="pull-right" style="padding-right: 10px;"><b>PHP {{data.total}}</b></label>
		</span>
		<span class="thank-you-item">
			<label></label>
			<label>Payment Method</label>
			<label class="pull-right" style="padding-right: 10px;" v-if="data.method.stripe !== null"><i class="fa fa-credit-card"></i>********{{data.method.stripe.last4}}</label>
			<label class="pull-right" style="padding-right: 10px;" v-if="data.method.payload === 'cod'">{{data.method.payload_value}}</label>
			<label class="pull-right" style="padding-right: 10px;" v-if="data.method.paypal !== null"><i class="fa fa-paypal"></i> {{data.method.paypal.email}}</label>
		</span>
	</div>
</template>
<style>
	.holder{
	  width: 100%;
	  float: left;
	  margin-top: 25px;
	  margin-bottom: 50px;
	}
	.holder .thank-you-header{
		height: 200px;
	  width: 100%;
	  float: left;
	  background: #22b173;
	  color: #fff;
	  text-align: center;
	  border-top-right-radius: 5px;
	  border-top-left-radius: 5px;
	}
	.holder .thank-you-header h1, .holder .thank-you-header h2{
		width: 100%;
		float: left;
	}
	.holder .thank-you-header label{
		float: left;
		width: 100%;
	}

	.thank-you-item{
		height: 50px;
	  width: 100%;
	  float: left;
	  line-height: 50px;
	  border-bottom: solid 1px #eee;
	  padding-left: 10px;
	}
	.thank-you-item label{
		width: 33%;
		float: left;
	}

</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
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
        }, {
          value: 'completed',
          column: 'status',
          clause: '='
        }, {
          value: this.$route.params.orderNumber,
          column: 'order_number',
          clause: '='
        }],
        account_id: this.user.userID
      }
      this.APIRequest('checkouts/retrieve_summary', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data[0]
        }else{
          this.data = null
        }
      })
    }
  }
}
</script>
