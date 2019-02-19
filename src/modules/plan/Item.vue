<template>
	<div class="holder">
    
    <div v-if="user.plan !== null">
      <div class="alert alert-danger" v-if="user.plan.title === 'Expired'">
        <strong>Your Plan was Expired!</strong> Please update or upgrade your plan to continue using ID Factory.
      </div>
      <div class="alert alert-success" v-if="user.plan.title !== 'Expired'">
        Your current plan <strong>{{user.plan.title.toUpperCase()}}</strong> will expired on {{user.plan.end_human}}.
      </div>
    </div>

    <div class="pricing-item">
      <span class="header-options option-false"></span>
      <span class="header-item bg-green">
        <label><b>BASIC</b></label>
      </span>
      <span class="pricing-content-holder">
        <span class="cost bg-green">
          <span class="top">
            <span class="value">{{products.currency + '' + products.basic}}</span>
          </span>
          <div class="bottom-pricing text-warning"><b>PER MONTH</b></div>
        </span>
        <span class="lead">
          <select class="form-control form-control-plan" v-model="basic">
            <option v-for="i in 12" v-bind:value="i">{{i}} 
              <label v-if="i === 1">Month</label>
              <label v-else>Months</label>
            </option>
          </select>
          <button class="btn btn-primary btn-whole" v-on:click="upgradePlan('basic', products.basic, basic)">
            Upgrade
          </button>
          <span class="text text-danger">
            <b>FEATURES</b>
          </span>
          <span class="text">
            Limited Storage
          </span>
          <span class="text">
            Expire after 1 Month
          </span>
          <button class="btn btn-primary btn-whole" v-on:click="upgradePlan('basic', products.basic, basic)">
            Upgrade
          </button>
        </span>
      </span>
    </div>

    <span class="pricing-item" style="margin-left: 2%;">
      <span class="header-item bg-secondary">
        <label><b>ENTERPRISE</b></label>
      </span>
      <span class="pricing-content-holder">
        <span class="cost bg-secondary">
          <span class="top">
            <span class="value">{{products.currency + '' + products.enterprise}}</span>
          </span>
          <span class="bottom-pricing text-warning"><b>PER MONTH</b></span>
        </span>
        <span class="lead">
          <select class="form-control form-control-plan" v-model="enterprise">
            <option v-for="i in 12" v-bind:value="i">{{i}} 
              <label v-if="i === 1">Month</label>
              <label v-else>Months</label>
            </option>
          </select>
          <button class="btn btn-primary btn-whole" v-on:click="upgradePlan('enterprise', products.enterprise, enterprise)">
            Upgrade
          </button>
          <span class="text text-danger">
            <b>FEATURES</b>
          </span>
          <span class="text">
            Unlimited Storage
          </span>
          <span class="text">
            Message to Clients
          </span>
          <span class="text">
            Card Editor
          </span>
          <span class="text">
            Notifications
          </span>
          <button class="btn btn-primary btn-whole" v-on:click="upgradePlan('enterprise', products.enterprise, enterprise)">
            Upgrade
          </button>
        </span>
      </span>
    </span>

    <span class="pricing-item" style="margin-left: 2%;">
      <span class="header-item bg-secondary">
        <label><b>PREMIUM</b></label>
      </span>
      <span class="pricing-content-holder">
        <span class="cost bg-secondary">
          <span class="top">
            <span class="value">{{products.currency + '' + products.premium}}</span>
          </span>
          <span class="bottom-pricing text-warning"><b>PER MONTH</b></span>
        </span>
        <span class="lead">
          <select class="form-control form-control-plan" v-model="premium">
            <option v-for="i in 12" v-bind:value="i">{{i}} 
              <label v-if="i === 1">Month</label>
              <label v-else>Months</label>
            </option>
          </select>
          <button class="btn btn-primary btn-whole" v-on:click="upgradePlan('premium', products.premium, premium)">
            Upgrade
          </button>
          <span class="text text-danger">
            <b>FEATURES</b>
          </span>
          <span class="text">
            Unlimited Storage
          </span>
          <span class="text">
            Message to Clients
          </span>
          <span class="text">
            Card Editor
          </span>
          <span class="text">
            Notifications
          </span>
          <button class="btn btn-primary btn-whole" v-on:click="upgradePlan('premium', products.premium, premium)">
            Upgrade
          </button>
        </span>
      </span>
    </span>
	</div>
</template>
<style scoped>
.holder{
	width: 100%;
	float: left;
	margin-bottom: 50px;
}

.pricing-item{
  width: 32%;
  float: left;
  min-height: 500px;
  overflow-y: hidden;
}

.pricing-item .header-item{
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  text-align: center;
  color: #fff;
  border: solid 1px inherit;
  float: left;
  width: 100%;
}
.pricing-item .header-item label{
  font-size: 24px;
  padding-top: 10px;
  padding-bottom: 5px;
}
.pricing-content-holder{
  width: 100%;
  float: left;
  min-height: 200px;
  overflow-y: hidden;
  border-left: solid 1px #22b173;
  border-right: solid 1px #22b173;
  border-bottom: solid 1px #22b173;
}

.pricing-content-holder .cost{
  width: 100%;
  float: left;
  min-height: 150px;
  text-align: right;
  color: #fff;
  overflow-y: hidden;
}
.pricing-content-holder .center{
  height: 250px;
}
.cost .top{
  width: 100%;
  float: left;
  text-align: center;
}
.cost .bottom-pricing {
  width: 100%;
  float: left;
  text-align: center;
  font-size: 18px;
  line-height: 40px;
  height: 40px;
}
.cost .top .value{
  font-size: 80px;
  font-weight: 600;
  float: left;
  width: 100%;
}

.cost .top .details{
  font-weight: 600;
  font-size: 16px;
  width: 100%;
}
.pricing-content-holder .other-details{
  width: 100%;
  float: left;
  background: #22b173;
}
.other-details .item{
  width: 100%;
  float: left;
  text-align: center;
  font-size: 20px;
  text-transform: uppercase;
  color: #fff;
  line-height: 50px;
  height: 50px;
}
.pricing-content-holder .lead{
  width: 100%;
  float: left;
  min-height: 50px;
  overflow-y: hidden;
}
.pricing-content-holder .lead .coupons{
  float: left;
  width: 80%;
  height: 50px;
  margin-left: 10%;
  margin-right: 10%;
  margin-bottom: 10px;
}
.pricing-content-holder .lead .coupon-message{
  width: 100%;
  float: left;
  text-align: center;
  margin-top: 10px;
  padding-bottom: 10px;
}
.lead .coupons input{
  width: 70% !important;
  float: left;
  height: 50px !important;
}
.lead .coupons .button-holder{
  width: 30% !important;
  float: left;
}
.lead .coupons .button-holder button{
  height: 50px !important;
  width: 90% !important;
}
.pricing-content-holder .lead .text{
  width: 100%;
  float: left;
  font-size: 14px;
  line-height: 50px;
  padding-left: 10%;
  border-bottom: solid 1px #ddd;
  font-weight: 400;
}
.pricing-content-holder .lead .btn-whole{
  width: 80%;
  text-align: center;
  float: left;
  margin: 25px 10% 10px 10%;
  height: 50px !important;
}

.bg-green{
  background: #22b173;
}

.form-control-plan{
  width: 80% !important;
  margin-left: 10% !important;
  margin-right: 10% !important;
  height: 50px !important;
  margin-top: 20px;
}
@media (max-width: 992px){
  .pricing-item{
    width: 90%;
    margin-left: 5%;
    margin-right: 5%;
    margin-bottom: 0px;
  }
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import PRODUCTS from '../../products.js'
export default {
  data(){
    return{
      user: AUTH.user,
      config: CONFIG,
      products: PRODUCTS,
      basic: 1,
      enterprise: 1,
      premium: 1
    }
  },
  methods: {
    redirect(route){
      ROUTER.push(route)
    },
    upgradePlan(plan, price, multiplier){
      let parameter = {
        account_id: this.user.userID,
        title: plan,
        price: price,
        sub_total: parseInt(price) * parseInt(multiplier),
        tax: 0,
        discount: 0,
        total_amount: parseInt(price) * parseInt(multiplier),
        status: 'added'
      }
      this.APIRequest('plans/create', parameter).done(response => {
        if(response.data > 0){
          this.redirect('/checkout_plan')
        }
      })
    }
  }
}
</script>
