<template>
  <div class="holder">
    <img :src="config.BACKEND_URL + user.profile.profile_url" class="profile" v-if="user.profile !== null">
    <i class="fa fa-user-circle-o" v-else></i>
    <label>{{user.username}}</label>
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
  width: 93%;
  float: left;
  height: 8vh;
  padding-left: 5px;
}
.profile{
  width: 50px;
  height: 50px;
  border-radius: 50%;
  float: left;

}
label{
  line-height: 50px;
  padding-left: 10px;
  float: left;
  align: center;
}

i{
  font-size: 50px;
  line-height: 50px;
  float: left;
}
</style>
