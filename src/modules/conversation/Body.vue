<template>
  <div class="holder">
    <div class="profile-icon">
      <div class="left-template">
      <img :src="config.BACKEND_URL + user.profile.profile_url" class="profile pull-left" v-if="user.profile !== null">
       <i class="fa fa-user-circle-o" v-else></i>
       <label class="content" >
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
         cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
         proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
         cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
         proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
         cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
         proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
       </label>
      </div>
      <div class="right-template">
       <label class="content">
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
         cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
         proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
       </label>
       <img :src="config.BACKEND_URL + user.profile.profile_url" class="profile pull-right" v-if="user.profile !== null">
       <i class="fa fa-user-circle-o pull-right" v-else></i>
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
