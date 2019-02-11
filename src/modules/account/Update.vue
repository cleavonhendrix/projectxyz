<template>
  <div class="update-holder">
    <div class="sidebar">
      <span class="header">
        Personal Settings
      </span>
      <span class="item" v-bind:class="{'make-active': item.flag === true}" v-for="item, index in menu" v-if="menu !== null" @click="makeActive(index)">
        {{item.title}}
      </span>
    </div>
    <div class="content">
      <profile v-if="menu[0].flag === true"></profile>
      <account v-if="menu[1].flag === true"></account>
      <payment v-if="menu[2].flag === true"></payment>
      <billing-information v-if="menu[3].flag === true"></billing-information>
      <merchant v-if="menu[4].flag === true"></merchant>
    </div>
  </div>

</template>
<style scoped>
.update-holder{
  width: 100%;
  float: left;
  margin-top: 25px;
}

.sidebar{
  width: 25%;
  float: left;
  border-top: solid 1px #ddd;
  border-right: solid 1px #ddd;
  border-left: solid 1px #ddd;
  border-top-right-radius: 2px;
  border-top-left-radius: 2px;
  min-height: 40px;
  overflow-y: hidden;
}
.sidebar .header{
  height: 40px;
  float: left;
  width: 100%;
  line-height: 40px;
  padding-left: 10px;
  border-bottom: solid 1px #ddd;
  background: #eee;
}
.sidebar .item{
  height: 40px;
  float: left;
  width: 100%;
  line-height: 40px;
  padding-left: 10px;
  border-bottom: solid 1px #ddd;
}
.item:hover{
  cursor: pointer;
  border-left: solid 2px #22b173 !important;
}
.make-active{
  border-left: solid 2px #22b173 !important;
}
.content{
  width: 75%;
  float: left;
  min-height: 50px;
  overflow-y: hidden;
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import axios from 'axios'
import CONFIG from '../../config.js'
export default {
  mounted(){
    AUTH.checkPlan()
    if(this.parameter !== null){
      let flag = false
      for (var i = 0; i < this.menu.length; i++) {
        if(this.parameter === this.menu[i].type){
          flag = true
          this.makeActive(i)
        }
      }
      if(flag === false){
        this.makeActive(0)
      }
    }else{
      this.makeActive(0)
    }
  },
  data(){
    return {
      user: AUTH.user,
      tokenData: AUTH.tokenData,
      config: CONFIG,
      menu: [
        {title: 'Profile', flag: true, type: 'profile'},
        {title: 'Account', flag: false, type: 'account'},
        {title: 'Payment Accounts', flag: false, type: 'payment_method'},
        {title: 'Billing Information', flag: false, type: 'billing_information'},
        {title: 'Merchant Setting', flag: false, type: 'merchant'}
      ],
      prevIndex: 0,
      parameter: this.$route.params.parameter
    }
  },
  components: {
    'profile': require('modules/account/Profile.vue'),
    'account': require('modules/account/Account.vue'),
    'payment': require('modules/payment/Create.vue'),
    'billing-information': require('modules/billing/Information.vue'),
    'merchant': require('modules/merchant/Settings.vue')
  },
  methods: {
    redirect(path){
      ROUTER.push(path)
    },
    makeActive(index){
      if(this.prevIndex === null){
        this.prevIndex = index
        this.menu[0].flag = false
        this.menu[this.prevIndex].flag = true
      }else{
        if(this.prevIndex !== index){
          this.menu[this.prevIndex].flag = false
          this.menu[index].flag = true
          this.prevIndex = index
        }
      }
    }
  }
}
</script>
