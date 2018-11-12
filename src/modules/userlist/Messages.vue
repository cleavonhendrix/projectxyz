<template>
  <div class="holder">
    <m-users></m-users>
    <m-options></m-options>
  </div>
</template>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
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
  components: {
    'm-users': require('modules/userlist/Card.vue'),
    'm-options': require('modules/userlist/OtherOptions.vue')
  },
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
}


</style>
