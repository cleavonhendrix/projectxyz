<template>
	<div class="holder">
    <create></create>
    <div class="results" v-if="data !== null">
      <table class="table table-bordered table-hover table-responsive" style="margin-top: 25px;">
        <thead>
          <tr>
            <td><b>Code</b></td>
            <td><b>Description</b></td>
            <td><b>Type</b></td>
            <td><b>Discount</b></td>
            <td><b>Start Date</b></td>
            <td><b>Expiry Date</b></td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item, index in data" v-if="data !== null" @click="editModal(item)" class="item">
            <td><b class="text-primary">{{item.code}}</b></td>
            <td>{{item.description}}</td>
            <td>{{item.type.toUpperCase()}}</td>
            <td>{{item.value}} <label v-if="item.type === 'percentage'">%</label></td>
            <td>{{item.start}}</td>
            <td>{{item.end}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <empty v-if="data === null" :title="'Looks like you have not added a coupons!'" :action="'Click the New Coupon Button to get started.'"></empty>
    <update></update>
	</div>
</template>
<style>
	.holder{  
    width: 98%;
    float: left;
    margin-right: 2%;
	  margin-top: 25px;
	  margin-bottom: 50px;
	}
  .results{
    width: 100%;
    float: left;
    margin-top: 25px;
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
    'create': require('modules/coupon/Create.vue'),
    'update': require('modules/coupon/Update.vue'),
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
        }]
      }
      $('#loading').css({'display': 'block'})
      this.APIRequest('coupons/retrieve', parameter).then(response => {
        $('#loading').css({'display': 'none'})
        if(response.data.length > 0){
          this.data = response.data
        }else{
          this.data = null
        }
      })
    },
    editModal(item){
      for (var i = 0; i < this.$children.length; i++) {
        if(this.$children[i].$el.id === 'updateCoupons'){
          this.$children[i].item = item
          this.$children[i].modal()
        }
      }
    }
  }
}
</script>
