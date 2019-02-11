<template>
  <div class="template-holder">
    <div class="template-list">
      <item></item>
      <history></history>
    </div>
  </div>
</template>
<style scoped>
.template-holder{
  width: 98%;
  float: left;
  margin-right: 2%;
}

.template-list{
  width: 100%;
  float: left;
  margin-top: 25px;
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
      prevIndex: null
    }
  },
  components: {
    'item': require('modules/plan/Item.vue'),
    'history': require('modules/plan/History.vue')
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
          value: 'ADDED',
          column: 'status',
          clause: '='
        }],
        account_id: this.user.userID
      }
      this.APIRequest('plans/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          ROUTER.push('/checkout_plan')
        }
      })
    }
  }
}
</script>

