<template>
  <div class="holder">
<!--     <img :src="config.BACKEND_URL + user.account_profile.profile_url" class="profile" v-if="user.account_profile !== null">
    <i class="fa fa-user-circle-o" v-else></i> -->
    <label>{{group.title}}</label>
    <span><i class="fa fa-plus-square" @click="newmessage()"></i></span>
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
  props: ['messengerGroupId'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    newmessage(){
      if(this.newMessageInput !== '' || this.newMessageInput !== null){
        let parameter = {
          messenger_group_id: this.messengerGroupId,
          message: this.newMessageInput,
          account_id: this.user.userID
        }
        this.APIRequest('messenger_messages/create', parameter).then(response => {
          if(response.data > 0){
            this.newMessageInput = null
            this.$parent.retrieve()
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
  height: 30vh;
}
span{
  width: 10%;
  float: right;
  height: 45px;
  line-height: 45px;
  text-align: right;
}
span i{
  font-size: 24px;
}

</style>
