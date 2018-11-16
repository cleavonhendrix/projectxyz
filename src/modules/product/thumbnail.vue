<template>
  <div class="card-columns">
    <div class="card">
      <img class="card-img-top" src="https://static1.squarespace.com/static/59e802b9be42d61a159cbf16/t/5ba8e6e21905f47667895b31/1537796041070/Screenshot_20180924-092343.png" alt="Card image cap">
      <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-light btn-lg btn-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Product Title should be Here
        </button>
      </h5>
    </div>
      <description></description>
    </div>
  </div>

</template>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  components: {
    'messageSeller': require('modules/product/messageSeller.vue'),
    'buyNow': require('modules/product/buyNow.vue'),
    'comments': require('modules/product/comments.vue'),
    'description': require('modules/product/description')
  },
  mounted(){
    this.retrieve()
  },
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      data: null
    }
  },
  props: ['payload', 'payloadValue'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: this.user.userID,
          column: 'account_id',
          clause: '='
        }]
      }
      this.APIRequest('products/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data
        }else{
          this.data = null
        }
      })
    }
  }
}
</script>

<style scooped>
  .card-columns {
  @include media-breakpoint-only(lg) {
    column-count: 4;
  }
  @include media-breakpoint-only(xl) {
    column-count: 5;
  }
}
</style>
