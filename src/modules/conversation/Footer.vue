<template>
  <div class="holder">
    <textarea type="text" class="form-control" placeholder="Type your message here..." v-model="newMessageInput" @keyup.enter="newmessage()">
    </textarea>
    <span>
      <i class="fas fa-location-arrow" @click="newmessage()"></i>
    </span>
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: left;
  height: 8vh;
  background: #22b173;
  color: #fff;
}
.profile{
  width: 50px;
  height: 50px;
  border-radius: 50%;
  float: left;
}

.btn{
  width: 10%;
  padding: 5px;
  float: right;
  height: 45px;
  position: relative;
  bottom: 60px;
  right: 13px;
  text-align: center;
}

.form-control{
  width: 89% !important;
  float: left !important;
  height: 6vh !important;
  margin-top: 1vh !important;
  margin-left: 1% !important;
}
span{
  width: 10%;
  float: left;
  height: 45px;
  line-height: 8vh;
  text-align: center;
}
span i{
  font-size: 24px;
}
span i:hover{
  cursor: pointer;
  color: #3f0050;
}

</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
export default {
  mounted(){
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      errorMessage: null,
      newMessageInput: null,
      prevNewMessageIndex: null
    }
  },
  props: ['group'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    newmessage(){
      if((this.newMessageInput !== '' || this.newMessageInput !== null) && this.group.new === false){
        let parameter = {
          messenger_group_id: this.group.id,
          message: this.newMessageInput,
          account_id: this.user.userID
        }
        this.APIRequest('messenger_messages/create', parameter).then(response => {
          if(response.data > 0){
            this.newMessageInput = null
            this.$parent.retrieve()
          }
        })
      }else if((this.newMessageInput !== '' || this.newMessageInput !== null) && this.group.new === true){
        let parameter = {
          creator: this.user.userID,
          message: this.newMessageInput,
          member: this.group.id
        }
        this.APIRequest('messenger_groups/create', parameter).then(response => {
          if(response.data !== null){
            this.newMessageInput = null
            this.$parent.group = response.data
            this.$parent.newFlag = false
            this.$parent.retrieve()
          }
        })
      }
    }
  }
}
</script>
