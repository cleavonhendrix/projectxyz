<template>
  <div class="holder">
    <div class="profile-icon" v-for="conversation, index in conversations" v-if="conversations !== null">
      <div class="left-template" v-if="user.userID !== parseInt(conversation.account_id)">
        <span class="date">
          {{conversation.created_at_human}}
        </span>
        <img :src="config.BACKEND_URL + conversation.account.profile.profile_url" class="profile pull-left" v-if="conversation.account.profile !== null && conversation.account !== null">
        <i class="fa fa-user-circle-o pull-left" v-else></i>
        <label class="content" >
          {{conversation.message}}
        </label>
      </div>
      <div class="right-template" v-else>
        <span class="date">
          {{conversation.created_at_human}}
        </span>
         <label class="content">
          <bdi>{{conversation.message}}</bdi>
         </label>
         <img :src="config.BACKEND_URL + conversation.account.profile.profile_url" class="profile pull-right" v-if="conversation.account.profile !== null && conversation.account !== null">
         <i class="fa fa-user-circle-o pull-right" v-else></i>
      </div>
      </div>
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: right;
  height: 74vh;
  overflow-y: scroll;
}
.profile{
  width: 25px;
  height: 25px;
  border-radius: 50%;
}
.left-template{
  width: 60%;
  float: left;
  margin-right: 40%;
  padding: 10px;
  min-height: 10px;
  overflow-y: hidden;
  margin-top: 10px;
  text-align: justify;
} 
.right-template{
  width: 60%;
  float: right;
  min-height: 10px;
  overflow-y: hidden;
  margin-top: 10px;
  margin-left: 40%;
  text-align: justify;
  direction: rtl;
}

.content{
  float: left;
  padding-left: 10px;
  width: 90%;
}

.left-template .date, .right-template .date{
  width: 100%;
  height: 20px;
  color: #aaa;
  font-size: 12px;
  float: left;
  line-height: 20px;
}
.left-template .date{
  padding-left: 8%;
}
.right-template .date{
  padding-right: 10%;
}

.left-template i, .right-template i{
  font-size: 25px;
  line-height: 25px; 
}
.holder::-webkit-scrollbar { width: 0; }
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
      config: CONFIG
    }
  },
  props: ['conversations'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    }
  }
}
</script>
