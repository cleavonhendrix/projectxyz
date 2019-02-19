<template>
  <div v-if="item !== null">
    <div class="messenger-header">
      <label class="back-icon" @click="changeConversationStatus('previous')"><i class="fa fa-chevron-left"></i></label>
      <div class="profile" v-if="item.last_message.account !== null">
        <img :src="config.BACKEND_URL + item.last_message.account.profile.profile_url" v-if="item.last_message.account.profile !== null">
        <i class="fa fa-user-circle-o text-green" v-else></i>
      </div>
      <span class="details">
        <label><b>ID Factory</b></label>
        <label>Active</label>
      </span>
    </div>
    <div class="conversation-content">
        <div class="message-holder">
          <messages :data="data" v-if="data !== null"></messages>
        </div>
        <div class="input-holder">
          <send :flag="false" :groupId="item.id"></send>
        </div>
    </div>
  </div>
</template>
<style scoped>
.messenger-header{
  width: 100%;
  float: left;
  height: 70px;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  background-image: linear-gradient(to right, #fffff0, #3f0050);
}
.messenger-header{
  line-height: 70px;
}
.back-icon{
  width: 40px;
  height: 40px;
  float: left;
  margin-top: 15px;
  text-align: center;
  margin-left: 2%;
  margin-right: 2%;
  line-height: 40px;
}
.back-icon:hover{
  border-radius: 5px;
  background: #3f0050;
  cursor: pointer;
  color: #fff;
}
.messenger-header .profile{
  float: left;
  width: 40px;
  height: 40px;
  margin-right: 2%;
}
.messenger-header .profile img{
  height: 40px;
  width: 40px;
  z-index: 0;
  border-radius: 50%;
}
.messenger-header .profile i{
  line-height: 40px;
  font-size: 40px;
  margin-top: 15px;
}

.messenger-header .details{
  float: left;
  height: 40px;
  margin-top: 20px;
}
.messenger-header .details label{
  width: 100%;
  float: left;
  line-height: 12px;
}

.conversation-content{
  height: 400px;
  width: 100%;
  float: left;
  background: #fff;
}
.message-holder{
  height: 340px;
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
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      data: null
    }
  },
  props: ['item'],
  components: {
    'send': require('modules/support/Send.vue'),
    'messages': require('modules/support/Messages.vue')
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
      if(this.item !== null){
        let parameter = {
          condition: [{
            column: 'messenger_group_id',
            value: this.item.id,
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
