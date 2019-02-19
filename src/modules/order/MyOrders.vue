<template>
  <div class="holder">
    <div class="title">
      <i class="fa fa-shopping-cart text-primary action-link" style="padding-right: 10px;"></i><label class="text-primary">My Orders</label>
    </div>
    <div class="results" v-if="data !== null">
      <table class="table table-bordered table-hover table-responsive" style="margin-top: 25px;">
        <thead>
          <tr>
            <td>Date</td>
            <td>Order Number</td>
            <td>Customer</td>
            <td>Amount</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item, index in data" v-if="data !== null" class="item">
            <td>{{item.order_date}}</td>
            <td>{{item.order_number}}</td>
            <td>
              <label v-if="item.partner_details !== null">{{item.partner_details.username}}</label>
              <label v-if="item.payload === 'direct'">ID Factory</label>
            </td>
            <td>{{item.total}}</td>
            <td>
              <label v-if="item.payload === 'direct'">{{item.status}}</label>
              <label v-if="item.payload !== 'direct'">{{item.printing_status}}</label>
            </td>
            <td>
              <i class="fa fa-shopping-cart text-primary" @click="redirect('/my_order_items/' + item.order_number)"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <empty v-if="data === null" :title="'Looks like you don\'t have order right now!'" :action="'Add your products so that customers can start engaging your business.'"></empty>
  </div>
</template>
<style>
  .holder{  
    width: 98%;
    float: left;
    margin-right: 2%;
    margin-bottom: 50px;
  }
  .title{
    width: 100%;
    float: left;
    font-size: 16px;
  }
  .results{
    width: 100%;
    float: left;
  }
  .item:hover{
    cursor: pointer;
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
  components: {
    'empty': require('modules/empty/Empty.vue')
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
        }]
      }
      $('#loading').css({display: 'block'})
      this.APIRequest('orders/retrieve_orders', parameter).then(response => {
        $('#loading').css({display: 'none'})
        if(response.data.length > 0){
          this.data = response.data
        }
      })
    },
    updateStatus(item){
      let parameter = {
        id: item.id,
        printing_status: item.printing_status
      }
      this.APIRequest('checkouts/update_status', parameter).then(response => {
        if(response.data === true){
          this.retrieve()
        }
      })
    }
  }
}
</script>
