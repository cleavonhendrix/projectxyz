<template>
  <div class="holder">
    <m-card v-for="group, index in groups" :key="group.id" :group="group" :index="index"></m-card>
    <m-options></m-options>
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
      config: CONFIG
    }
  },
  props: ['groups'],
  components: {
    'm-card': require('modules/userlist/Card.vue'),
    'm-options': require('modules/userlist/OtherOptions.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    makeActive(selectedIndex){
      this.$parent.selectedGroup(selectedIndex)
    }
  }
}
</script>
<style scoped>
.holder{
  width: 100%;
  float: right;
}


</style>
