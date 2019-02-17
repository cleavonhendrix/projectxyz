<template>
  <div class="support-messenger">
    <div class="messenger-content" v-if="flag === true">
      <start  v-if="conversationStatus === 'start'"></start>
      <new-conversation v-if="conversationStatus === 'new-conversation'"></new-conversation>
      <conversation v-if="conversationStatus === 'conversation' && group !== null" :item="group"></conversation>
      <previous v-if="conversationStatus === 'previous'"></previous>
    </div>
    <div class="messenger-content-first" v-if="conversationStatus === 'initial' && flag === false && user.username !== null">
      <label class="username" v-if="user.username.length < 20">Hi {{user.username}}!</label>
      <label class="username" v-else>Hi {{user.username.substr(0, 17)}}...!</label>
      <label class="question" v-if="user.type !== 'ADMIN' && user.type !== 'SUPPORT'">Is there anything we can help for you?</label>
      <label class="question" v-else>Please answers the inquiries.</label>
    </div>
    <span class="messenger-icon"  @click="changeFlag()">
      <i class="fas fa-comment" v-if="flag === false"></i>
      <i class="fa fa-close" v-if="flag === true"></i>
    </span>
  </div>
</template>
<style scoped>
.support-messenger{
  min-width: 50px;
  min-height: 50px;
  overflow: hidden;
  position: fixed;
  bottom: 10px;
  right: 10px;
  max-width: 325px;
  z-index: 1000;
}
.messenger-icon{
  height: 60px;
  width: 60px;
  float: right;
  border-radius: 50%;
  background: #3f0050;
  color: #fff;
  text-align: center;
}
.messenger-icon:hover{
  cursor: pointer;
  color: #3f0050;
  background: #fff;
  border: solid 1px #3f0050;
}
.messenger-icon i{
  font-size: 30px;
  line-height: 60px;
}
.messenger-content{
  height: 470px;
  width: 325px;
  border-radius: 10px;
  float: left;
  border: solid 1px #ddd;
  margin-bottom: 20px;
  background: #fff;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.messenger-content-first{
  height: 60px;
  width: 255px;
  margin-right: 10px;
  border-radius: 5px;
  float: left;
  background: #3f0050;
  border: solid 1px #ddd;
  color: #fff;
}
.messenger-content-first .username{
  font-size: 18px;
  line-height: 12px;
  float: left;
  width: 90%;
  margin-right: 5%;
  margin-left: 5%;
  padding-top: 10px;
  font-weight: 600;
}

.messenger-content-first .question{
  line-height: 12px;
  float: left;
  width: 90%;
  margin-right: 5%;
  margin-left: 5%;
  font-size: 12px;
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
      flag: false,
      conversationStatus: 'initial',
      group: null
    }
  },
  components: {
    'start': require('modules/support/Start.vue'),
    'previous': require('modules/support/Previous.vue'),
    'conversation': require('modules/support/Conversation.vue'),
    'new-conversation': require('modules/support/NewConversation.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    changeFlag(){
      this.flag = !this.flag
      if(this.conversationStatus === 'initial'){
        this.conversationStatus = 'start'
      }
    }
  }
}
</script>
