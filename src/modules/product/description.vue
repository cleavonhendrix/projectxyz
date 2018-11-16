<template>
  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h4>₱ XX,XXX.XX</h4>
          </div>
          <div class="col">
            <comments></comments>
          </div>
        </div>
        
        <br>
        <ratings></ratings>
        <br>
        <p><br>Product description should be here. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </p>
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messengerLink">Message Seller</button>
          <messageSeller></messageSeller>
         <button class="btn btn-warning" data-toggle="modal" data-target="#buyNow">Buy Now!</button>
          <buyNow></buyNow>
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
    'ratings': require('modules/rating/Ratings.vue'),
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
