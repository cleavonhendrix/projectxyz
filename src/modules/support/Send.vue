<template>
  <div class="holder">
    <input type="text" class="custom-input" placeholder="Send a message" v-model="newMessageInput" @keyup.enter="newmessage()">
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: left;
  height: 60px;
}
.custom-input{
  border: 0px;
  height: 59px;
  width: 100%;
  float: left;
  padding-left: 10px;
  padding-right: 10px;
  color: #555;
}
.custom-input:focus{
  outline: none;
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  mounted(){
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      newMessageInput: null
    }
  },
  props: ['flag', 'groupId'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    newmessage(){
      if((this.newMessageInput !== '' || this.newMessageInput !== null) && this.flag === false){
        let parameter = {
          messenger_group_id: this.groupId,
          message: this.newMessageInput,
          account_id: this.user.userID
        }
        this.APIRequest('messenger_messages/create', parameter).then(response => {
          if(response.data > 0){
            this.newMessageInput = null
            this.$parent.retrieve()
          }
        })
      }else if((this.newMessageInput !== '' || this.newMessageInput !== null) && this.flag === true){
        let parameter = {
          creator: this.user.userID,
          message: this.newMessageInput
        }
        this.APIRequest('messenger_groups/create_new_issue', parameter).then(response => {
          if(response.data > 0){
            this.$parent.groupId = response.data
            this.$parent.flag = false
            this.newMessageInput = null
          }
        })
      }
    }
  }
}
</script>
