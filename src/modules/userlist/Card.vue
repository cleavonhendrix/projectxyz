<template>
  <div class="holder" @click="selected(index)">
<!--     <img :src="config.BACKEND_URL + item.account_profile.profile_url" class="profile" v-if="item.account_profile !== null">
    <i class="fa fa-user-circle-o" v-else></i> -->
    <label>{{group.title}}
      <span class="badge badge-primary">{{group.total_members}}</span>
    </label>
    
  </div>
</template>
<style scoped>
.holder{
  width: 100%;
  float: left;
  height: 50px;
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

.holder:hover{
  cursor: pointer;
  background: #ddd;
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
  props: ['group', 'index'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    selected(index){
      this.$parent.makeActive(index)
    }
  }
}
</script>

