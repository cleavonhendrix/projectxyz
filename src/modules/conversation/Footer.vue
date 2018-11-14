<template>
  <div class="holder">
    <textarea type="text" class="form-control" placeholder="New Message..." v-model="newMessageInput" @keyup.enter="newmessage(id)">
    </textarea>
    <button type="button" class="btn btn-primary" @click="newmessage()">Send</button>
  </div>
</template>
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
  props: ['messengerGroupId'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    newmessage(){
      if(this.newMessageInput !== '' || this.newMessageInput !== null){
        let parameter = {
          messenger_group_id: this.messengerGroupId,
          message: this.newMessageInput,
          account_id: this.user.userID
        }
        this.APIRequest('messenger_messages/create', parameter).then(response => {
          if(response.data > 0){
            this.newMessageInput = null
            this.$parent.retrieve()
          }
        })
      }
    }
  }
}
</script>
<style scoped>
.holder{
  width: 100%;
  float: left;
  height: 15vh;
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
  padding: 10px;
  margin: 10px;
  width: 85%;
  height: 10vh;
  resize: none;
}

</style>
