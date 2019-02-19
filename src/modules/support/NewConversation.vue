<template>
  <div>
    <div class="messenger-header">
      <div class="messenger-logo">
        <label class="back-icon" @click="changeConversationStatus('start')"><i class="fa fa-chevron-left"></i></label>
        <label><b>ID FACTORY</b></label>
      </div>
      <div class="messenger-info">
        <p>
          Hello! What question do you have about ID Factory? We'd love to help you.
        </p>
      </div>
    </div>
    <div class="conversation-content">
      <div class="message-holder">
        <messages :data="data"  v-if="data !== null"></messages>
      </div>
      <div class="input-holder">
        <send :flag="flag" :groupId="groupId"></send>
      </div>
    </div>
  </div>
</template>
<style scoped>
.messenger-header{
  width: 100%;
  float: left;
  height: 200px;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  background-image: linear-gradient(to bottom right, #ffffff, #3f0050);
}
.messenger-header .messenger-logo{
  height: 50px;
  float: left;
  width: 100%;
  margin-top: 20px;
}
.messenger-logo .back-icon{
  width: 40px;
  height: 40px;
  float: left;
  margin-top: 5px;
  text-align: center;
  margin-left: 2%;
  margin-right: 2%;
}
.messenger-logo .back-icon:hover{
  border-radius: 5px;
  background: #3f0050;
  cursor: pointer;
  color: #fff;
}
.messenger-logo label{
  line-height: 40px;
  font-size: 24px;
  margin-top: 5px;
  color: #3f0050;
}
.messenger-header .messenger-info{
  float: left;
  width: 70%;
  margin-right: 15%;
  margin-left: 15%;
  text-align: justify;
  padding-top: 15px;
}
.messenger-info h3{
  text-transform: capitalize;
  color: #000;
}
.start-header{
  height: 50px;
  width: 90%;
  margin-right: 5%;
  margin-left: 5%;
  margin-top: 10px;
}
.start-actions{
  height: 50px;
  width: 90%;
  margin-right: 5%;
  margin-left: 5%;
}
.start-header .title{
  font-size: 14px;
  line-height: 14px;
  width: 100%;
  float: left;
}
.start-header .description{
  line-height: 12px;
  width: 100%;
  float: left;
  color: #888;
}
.previous{
  line-height: 35px;
}
.previous:hover{
  text-decoration: underline;
  cursor: pointer;
}
.conversation-content{
  height: 270px;
  width: 100%;
  float: left;
  background: #fff;
}
.message-holder{
  height: 210px;
  overflow-y: auto;
  width: 100%;
  float: left;
  background: #fff;
  display: flex;
  flex-direction: column-reverse;
}
.input-holder{
  height: 60px;
  width: 100%;
  float: left;
  background: #fff;
  border-top: solid 1px #ddd;
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
      data: null,
      groupId: null,
      flag: true
    }
  },
  components: {
    'send': require('modules/support/Send.vue'),
    'messages': require('modules/support/Messages.vue')
  },
  watch: {
    groupId: function(newVal, oldVal) { // watch it
      this.groupId = newVal
      this.retrieve()
    }
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    changeConversationStatus(status){
      this.$parent.conversationStatus = status
      AUTH.messengerSupport.flag = null
    },
    retrieve(){
      if(this.groupId !== null){
        let parameter = {
          condition: [{
            column: 'messenger_group_id',
            value: this.groupId,
            clause: '='
          }]
        }
        this.APIRequest('messenger_messages/retrieve', parameter).done(response => {
          if(response.data.length > 0){
            this.data = response.data
          }else{
            this.data = null
          }
          if(AUTH.messengerSupport.flag === true){
            setTimeout(() => {
              this.retrieve()
            }, 1000)
          }
        })
      }
    }
  }
}
</script>
