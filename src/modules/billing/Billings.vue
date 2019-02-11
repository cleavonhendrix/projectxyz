<template>
	<div class="employee-holder">
		<create></create>
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
      config: CONFIG,
      errorMessage: null
    }
  },
  components: {
    'create': require('modules/entry/Create.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    submit(){
      if(this.validate()){
      }
    },
    validate(){
    }
  }
}
</script>
<style scoped>
.employee-holder{
	width: 100%;
	float: left;
	height: 100%;
}
</style>
