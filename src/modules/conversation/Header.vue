<template>
  <div class="holder" v-if="group !== null">
    <img :src="config.BACKEND_URL + group.title.profile.profile_url" class="profile" v-if="group.title.profile !== null">
    <i class="fa fa-user-circle-o" v-else></i>
    <label>{{group.title.username}}
      <!-- <span class="badge badge-primary">{{group.total_members}}</span> -->
    </label>
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: left;
  height: 8vh;
  padding-left: 5px;
  border-bottom: solid 1px #eee;
}
.profile{
  width: 40px;
  height: 40px;
  border-radius: 50%;
  float: left;
  margin-top: 5px;
}


label{
  line-height: 50px;
  padding-left: 10px;
  float: left;
  align: center;
}

i{
  font-size: 40px;
  line-height: 50px;
  float: left;
  color: #22b173;
}
</style>
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
