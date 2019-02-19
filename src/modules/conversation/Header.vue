<template>
  <div class="holder" v-if="group !== null">
    <i class="fa fa-user-circle-o"></i>
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
