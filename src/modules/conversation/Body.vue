<template>
  <div class="holder">
    <div class="profile-icon" v-for="conversation, index in conversations" v-if="conversations !== null">
      <div class="left-template" v-if="user.userID !== conversation.account_id">
      <!-- <img :src="config.BACKEND_URL + conversation.account.profile.profile_url" class="profile pull-left" v-if="conversation.account.profile !== null && conversation.account !== null"> -->
       <i class="fa fa-user-circle-o"></i>
       <label class="content" >
        {{conversation.message}}
       </label>
      </div>
      <div class="right-template" v-else>
       <label class="content">
        {{conversation.message}}
       </label>
       <!-- <img :src="config.BACKEND_URL + cconversation.account.profile.profile_url" class="profile pull-right" v-if="conversation.account.profile !== null && conversation.account !== null"> -->
       <i class="fa fa-user-circle-o pull-right"></i>
      </div>
      </div>
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: right;
  height: 66vh;
  overflow-y: scroll;
}
.profile{
  width: 25px;
  height: 25px;
  border-radius: 50%;
}
.left-template{
  border-top-right-radius: 10px;
  border-top-left-radius: 30px;
  border-bottom-right-radius: 10px;
  width: 90%;
  background: #eee;
  color: black;
  float: left;
  padding: 10px;
  min-height: 100px;
  overflow-y: hidden;
  margin-top: 10px;

} 
.right-template{
  width: 90%;
  float: right;
  background: #0084ff;
  color: #fff;
  padding: 10px;
  min-height: 100px;
  overflow-y: hidden;
  margin-top: 10px;
  border-top-right-radius: 30px;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.right-template:last-of-type {
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 30px;
}
.content{
  float: left;
  padding-left: 10px;
  width: 93%;

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
