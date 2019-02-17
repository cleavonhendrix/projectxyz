<template>
  <div>
    
    <div class="messenger-holder" v-if="groups !== null || partners !== null">
      <div class="conversation">
        <conversation :groupId.sync="groupId" :group="selectedGroupData"></conversation>   
      </div>
      <div class="users">
        <groups :groups="groups" :partners="partners" v-if="groups !== null || partners !== null"></groups>
      </div>
    </div>

    <empty v-if="groups === null && partners === null" :title="'You do not have conversation right now.'" :action="'Wait for your customer to message you.'"></empty>
  </div>
</template>
<style scoped>
.messenger-holder{
  width: 100%;
  float: left;
}
.conversation{
  width: 70%;
  float: left;
  min-height: 500px;
  overflow-y:hidden;
  height: 90vh;
}
.users{
  width: 28%;
  float: left;
  height: 90vh;
  margin-left: 2%; 
  overflow-y:scroll;
  border-left: solid 1px #22b173;
}

.users::-webkit-scrollbar { width: 0; }
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
    AUTH.checkPlan()
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      newTitle: null,
      data: null,
      groups: null,
      partners: null,
      selectedIndex: 0,
      selectedGroupData: null,
      prevModuleSelected: null,
      username: this.$route.params.username
    }
  },
  props: ['params'],
  components: {
    'conversation': require('modules/conversation/Conversation.vue'),
    'groups': require('modules/userlist/Groups.vue'),
    'empty': require('modules/empty/Empty.vue')
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
        account_id: this.user.userID,
        account_type: this.user.type,
        username: (this.username) ? this.username : ''
      }
      this.APIRequest('messenger_groups/retrieve', parameter).done(response => {
        if(response.data.length > 0){
          this.groups = response.data
          this.partners = response.accounts
          if(this.partners !== null){
            this.prevModuleSelected = 'partners'
            this.selectedGroup(0, 'partners')
          }else if(this.groups !== null){
            this.prevModuleSelected = 'groups'
            this.selectedGroup(response.active, 'groups')
          }
        }else{
          this.groups = null
          this.partners = null
        }
      })
    },
    selectedGroup(index, moduleText){
      this.selectedIndex = index
      var i = 0
      if(moduleText === 'groups'){
        this.groupId = this.groups[index].id
        this.selectedGroupData = this.groups[index]
        for (i = 0; i < this.$children.length; i++) {
          if(this.$children[i].$el.id === 'groupConversation'){
            this.$children[i].newFlag = false
            this.$children[i].conversations = null
          }
        }
      }else if(moduleText === 'partners'){
        this.groupId = null
        this.selectedGroupData = this.partners[index]
        for (i = 0; i < this.$children.length; i++) {
          if(this.$children[i].$el.id === 'groupConversation'){
            this.$children[i].newFlag = true
            this.$children[i].conversations = null
            this.$children[i].retrieve()
          }
        }
      }
    },
    makeActiveCard(index, moduleText){
      if(moduleText === 'groups' && this.prevModuleSelected === 'groups'){
        if(this.selectedIndex !== index){
          this.groups[this.selectedIndex].flag = false
          this.groups[index].flag = true
        }
      }
      if(moduleText === 'groups' && this.prevModuleSelected === 'partners'){
        this.partners[this.selectedIndex].flag = false
        this.groups[index].flag = true
      }
      if(moduleText === 'partners' && this.prevModuleSelected === 'groups'){
        this.groups[this.selectedIndex].flag = false
        this.partners[index].flag = true
      }
      if(moduleText === 'partners' && this.prevModuleSelected === 'partners'){
        if(this.selectedIndex !== index){
          this.groups[this.selectedIndex].flag = false
          this.groups[index].flag = true
        }
      }
      this.prevModuleSelected = moduleText
      this.selectedGroup(index, moduleText)
    }
  }
}
</script>
