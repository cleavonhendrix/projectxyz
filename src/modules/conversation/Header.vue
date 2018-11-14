<template>
  <div class="holder" v-if="group !== null">
<!--     <img :src="config.BACKEND_URL + user.account_profile.profile_url" class="profile" v-if="user.account_profile !== null">
    <i class="fa fa-user-circle-o" v-else></i> -->
    <label>{{group.title}}</label>
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
      config: CONFIG
    }
  },
  props: ['group'],
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
