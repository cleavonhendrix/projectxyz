<template>
  <div class="holder">
    <div class="users-list" v-for="i in 11">
      <div class="messages">
        <img :src="config.BACKEND_URL + user.profile.profile_url" class="profile" v-if="user.profile !== null">
      <i class="fa fa-user-circle-o" v-else></i>
      <label>{{user.username}}</label>
      <div class="m-body">
        <label>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        </label>
      </div>
      </div>
    </div>
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
      config: CONFIG
    }
  },
  props: ['params'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    }
  }
}
</script>
<style scoped>
.holder{
  width: 100%;
  float: left;
  height: 66vh;
  overflow-y: scroll;
}
.profile{
  width: 10%;
  height: 10%;
  border-radius: 50%;
  margin: 5px;
  margin-left: 10px;
}
.users-list{
  padding: 3px;
}
.messages{
  max-height: 100px;
  min-height: 50px;
  width: 100%;
  overflow-y: hidden;
}

.messages:hover{
  background: #999;
}
.m-body{ 
  margin-left: 5px;
}
</style>
