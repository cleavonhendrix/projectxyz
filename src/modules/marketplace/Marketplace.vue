<template>
  <div class="marketplace-holder">
    <div class="banner text-white">
      <h1>Welcome to Marketplace!</h1>
      <h3>We have all you need.</h3>
    </div>

    <div class="product-holder">
      <div class="listing">
        <div class="filter" v-if="data !== null">
          <div class="input-group">
            <span class="input-group-addon">Search</span>
            <input type="text" class="form-control" v-model="searchValue" placeholder="Search here...">
          </div>
        </div>
        <div class="results">
          <products v-if="data !== null" :data="data"></products>
          <empty v-if="data === null" :title="'No products yet!'" :action="'Please be back soon.'" :icon="'far fa-smile'" :iconColor="'text-primary'"></empty>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.marketplace-holder{
  width: 100%;
  float: left;
  min-height: 10px;
  overflow-y: hidden;
  margin-bottom: 50px;
}
.banner{
  width: 100%;
  float: left;
  min-height: 50px;
  overflow-y: hidden;
  padding: 20px;
  background: #ffaa81;
}
.product-holder{
  width: 100%;
  float: left;
  min-height: 10px;
  overflow-y: hidden;
}
.listing{
  width: 100%;
  float: left;
  min-height: 10px;
  overflow-y: hidden;
}
.listing .filter{
  width: 100%;
  float: left;
  height: 50px;
  margin-top: 25px;
}

.form-control{
  height: 45px !important;
}
.input-group{
  margin-bottom: 10px !important;
}
.input-group-addon{
  width: 100px !important;
  background: #22b173 !important;
  color: #fff !important;
}
.input-group-title{
  width: 100px !important;
  background: #028170 !important;
  color: #fff !important;
}

.listing .results{
  width: 100%;
  font-size: left;
  min-height: 10px;
  overflow-y: hidden;
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
      errorMessage: null,
      data: null,
      searchValue: null
    }
  },
  components: {
    'products': require('modules/marketplace/Products.vue'),
    'empty': require('modules/empty/EmptyDynamicIcon.vue')
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: 'published',
          column: 'status',
          clause: '='
        }],
        account_id: this.user.userID
      }
      this.APIRequest('products/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data
        }
      })
    }
  }
}
</script>

