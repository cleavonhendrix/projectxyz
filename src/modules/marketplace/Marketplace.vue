<template>
  <div>
    <filters></filters>
    <br>
    <products></products>
  </div>
</template>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  components: {
    'products': require('modules/product/Products.vue'),
    'filters': require('modules/MarketplaceHeader/Filters.vue')
  },
  mounted(){
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      menus: [
        {title: 'Menu 1', 'icon': 'fa fa-plus'},
        {title: 'Menu 2', 'icon': 'fa fa-plus'},
        {title: 'Menu 3', 'icon': 'fa fa-plus'},
        {title: 'Menu 4', 'icon': 'fa fa-plus'},
        {title: 'Menu 5', 'icon': 'fa fa-plus'},
        {title: 'Menu 6', 'icon': 'fa fa-plus'}
      ],
      hello: 'Hi'
    }
  },
  props: ['params'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    }
  }
}
</script>
<style scoped>
.sample{
  padding: 0px;
  margin: 0px;
  width: 100%;
  float: left;
}

.sample li{
  width: 100%;
  float: left;
  height: 50px;
}
</style>
