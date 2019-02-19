<template>
  <div class="holder" v-if="data !== null">
    <span class="header">Merchant Settings</span>
    <span class="content">
      <span class="error text-danger" v-if="errorMessage !== null">
        <b>Oops!</b> {{errorMessage}}
      </span>
      <span class="error text-success" v-if="successMessage !== null">
        {{successMessage}}
      </span>
      <span class="inputs">
        <div class="form-group" style="margin-top: 25px;">
          <label for="address">Order Number Prefix</label>
          <input type="text" class="form-control" placeholder="Optional" v-model="data.order_suffix">
        </div>
        
        <button class="btn btn-primary" style="margin-bottom: 25px;" @click="update()">Update</button>
      </span>
      <span class="sidebar">
      </span>
    </span>
  </div>
</template>
<style scoped>
.holder{
  width: 95%;
  float: left;
  margin-left: 5%;
}
.header{
  width: 100%;
  height: 50px;
  line-height: 50px;
  font-size: 24px;
  border-bottom: solid 1px #ddd;
  float: left;
}
.content{
  width: 100%;
  min-height: 50px;
  float: left;
  overflow-y: hidden;
}
.content .error{
  width: 100%;
  float: left;
  height: 40px;
  line-height: 40px;
}
.inputs{
  width: 65%;
  float: left;
  margin-right: 5%;
  min-height: 50px;
  overflow-y: hidden;
}
.sidebar{
  width: 30%;
  float: left;
  min-height: 50px;
  overflow-y: hidden;
}
.sidebar-header{
  height: 40px;
  line-height: 40px;
  width: 100%;
  float: left;
}
.sidebar .image{
  width: 100%;
  float: left;
  min-height: 200px;
  overflow-y: hidden;
  text-align: center;
}
.image i{
  font-size: 150px;
  line-height: 200px;
}
.image img{
  border-radius: 5px;
}
.custom-block{
  width: 100%;
  float: left;
}
.custom-block input{
  display: none;
}
.row{
  margin: 0px !important;
}
.row .left{
  padding-left: 0px !important;
}
.row .right{
  padding-right: 0px !important;
}
@media screen and (max-width: 992px){
  .holder{
    width: 96%;
    margin-left: 2%;
    margin-right: 2%;
  }
  .sidebar, .inputs{
    width: 100%;
    margin-right: 0%;
    margin-left: 0%;
  }
  .row .form-group{
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import axios from 'axios'
import CONFIG from '../../config.js'
export default {
  mounted(){
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      tokenData: AUTH.tokenData,
      config: CONFIG,
      data: null,
      errorMessage: null,
      successMessage: null
    }
  },
  methods: {
    retrieve(){
      let parameter = {
        condition: [{
          value: this.user.userID,
          column: 'id',
          clause: '='
        }]
      }
      this.APIRequest('accounts/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data[0]
        }
      })
    },
    update(){
      if(this.validate()){
        let parameter = {
          id: this.data.id,
          order_suffix: this.data.order_suffix
        }
        this.APIRequest('accounts/update_verification', parameter).then(response => {
          if(response.data === true){
            this.retrieve()
            this.successMessage = 'Successfully Updated!'
            this.errorMessage = null
          }else{
            this.successMessage = null
            this.errorMessage = 'Unable to Update! Please contact the administrator.'
          }
        })
      }
    },
    validate(){
      let temp = this.data
      if(temp.order_suffix !== null && temp.order_suffix !== ''){
        return true
      }else{
        this.errorMessage = 'Please fill up all required fields.'
        return false
      }
    }
  }
}
</script>
