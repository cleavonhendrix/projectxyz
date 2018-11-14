<template>
  <div class="holder">
    <div class="conversation">
      <conversation></conversation>   
    </div>
    <div class="users">
      <groups :groups="groups" v-if="groups !== null"></groups>
    </div>
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: left;
}
.conversation{
  width: 70%;
  float: left;
  min-height: 500px;
  overflow-y:hidden;
}
.users{
  width: 30%;
  float: left;
  height: 90vh; 
  padding: 2px;
  overflow-y:hidden;
}
@media (max-width: 992px){
  .users{
    display: none;
  }
  .conversation{
    width: 100%;
  }
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
      newTitle: null,
      data: null,
      groups: null,
      selectedIndex: 0
    }
  },
  props: ['params'],
  components: {
    'conversation': require('modules/conversation/Conversation.vue'),
    'groups': require('modules/userlist/Groups.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    create(){
      if(this.newTitle !== null || this.newTitle !== ''){
        let parameter = {
          'account_id': this.user.userID,
          'title': this.newTitle
        }
        this.APIRequest('messenger_groups/create', parameter).then(response => {
          console.log(response)
        })
      }
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: this.user.userID,
          column: 'account_id',
          clause: '='
        }]
      }
      this.APIRequest('messenger_groups/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.groups = response.data
        }else{
          this.groups = null
        }
      })
    },
    selectedGroup(index){
      for (var i = 0; i < this.$children.length; i++) {
        if(this.$children[i].$el.id === 'groupConversation'){
          this.$children[i].group = this.groups[index]
          this.$children[i].retrieve()
        }
      }
    }
  }
}
</script>
