<template>
  <div class="holder">
    <table class="table">

      <thead>
       
        <tr>
          <td>ID</td>
          <td>Title</td>
          <td>Description</td>
          <td>SKU</td>
          <td>Status</td>
        </tr>
      </thead>



      <tbody>
        <tr v-for="item, index in data" v-if="data !== null">
          <td>{{item.id}}</td>
          <td>{{item.title}}</td>
          <td>{{item.description}}</td>
          <td>{{item.sku}}</td>
          <td>{{item.status}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
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
      data: null
    }
  },
  props: ['payload', 'payloadValue'],
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
      this.APIRequest('products/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data
        }else{
          this.data = null
        }
      })
    }
  }
}
</script>
<style scoped>
.holder{
  width: 100%;
  float: left;
  margin-top: 20px;
}

</style>
