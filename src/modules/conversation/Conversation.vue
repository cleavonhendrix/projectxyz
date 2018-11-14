<template>
  <div class="holder" id="groupConversation">
    <c-header :group="group" v-if="group !== null"></c-header>
    <c-body :conversations="conversations" v-if="group !== null"></c-body>
    <c-footer :messengerGroupId="group.id" v-if="group !== null"></c-footer>
  </div>
</template>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      conversations: null,
      group: null
    }
  },
  components: {
    'c-header': require('modules/conversation/Header.vue'),
    'c-body': require('modules/conversation/Body.vue'),
    'c-footer': require('modules/conversation/Footer.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      if(this.group !== null){
        let parameter = {
          condition: [{
            value: this.group.id,
            column: 'messenger_group_id',
            clause: '='
          }],
          sort: {
            'created_at': 'ASC'
          }
        }
        this.APIRequest('messenger_messages/retrieve', parameter).then(response => {
          if(response.data.length > 0){
            this.conversations = response.data
          }else{
            this.conversations = null
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
}

</style>
