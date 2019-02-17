<template>
  <div class="holder" id="groupConversation">
    <c-header :group="group" v-if="group !== null"></c-header>
    <c-body :conversations="conversations" v-if="group !== null"></c-body>
    <c-footer :group="group" v-if="group !== null"></c-footer>
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: left;
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  mounted(){
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      conversations: null,
      id: null,
      newFlag: false
    }
  },
  components: {
    'c-header': require('modules/conversation/Header.vue'),
    'c-body': require('modules/conversation/Body.vue'),
    'c-footer': require('modules/conversation/Footer.vue')
  },
  props: ['groupId', 'group'],
  watch: {
    groupId: function(newVal, oldVal) { // watch it
      this.groupId = newVal
      this.retrieve()
    }
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      if(this.groupId && this.group.new === false){
        let parameter = {
          condition: [{
            value: this.groupId,
            column: 'messenger_group_id',
            clause: '='
          }],
          sort: {
            'created_at': 'ASC'
          }
        }
        this.APIRequest('messenger_messages/retrieve', parameter).done(response => {
          if(response.data.length > 0){
            this.conversations = response.data
          }else{
            this.conversations = null
          }
          if(AUTH.messenger.flag === true){
            setTimeout(() => {
              this.retrieve()
            }, 1000)
          }
        })
      }else{
        this.conversations = null
      }
    }
  }
}
</script>
