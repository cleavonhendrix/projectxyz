<template>
  <div class="holder">
    <textarea type="text" class="form-control" placeholder="New Message..." v-model="newMessageInput" @keyup.enter="newmessage(id)">
    </textarea>
    <button type="button" class="btn btn-primary" @click="newmessage(id)">Send</button>
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
  props: ['params'],
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
      this.APIRequest('messenger_groups/retrieve', parameter).then(response => {
        this.data = response.data
      })
    },
    newmessage(id){
      if(this.newMessageInput !== '' || this.newMessageInput !== null){
        let parameter = {
          payload: 'event',
          payload_value: id,
          account_id: this.user.userID,
          text: this.newMessageInput
        }
        this.APIRequest('messenger_groups/create', parameter).then(response => {
          if(response.data > 0){
            this.prevNewMessageIndex = null
            this.retrieve()
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
