<template>
  <div>
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#createCouponModal"><i class="fa fa-plus"></i> New Coupon
    </button>
    <div class="modal fade" id="createCouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">New Coupon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text-white">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span v-if="errorMessage !== null" class="text-danger text-center">
                <label><b>Opps! </b>{{errorMessage}}</label>
            </span>
            <br v-if="errorMessage !== null">
            <br>
            <div class="form-group">
              <label for="exampleInputEmail1">Code <label class="text-danger">*</label></label>
              <input type="text" class="form-control" placeholder="Type code here..." v-model="input.code">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <input type="text" class="form-control" placeholder="Type description here..." v-model="input.description">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Type <label class="text-danger">*</label></label>
              <select class="form-control" v-model="input.type">
                <option value="percentage">Percentage</option>
                <option value="fixed_amount">Fixed Amount</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Value</label>
              <input type="text" class="form-control" placeholder="Type value here..." v-model="input.value">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Start On <label class="text-danger">*</label></label>
              <input type="datetime-local" class="form-control" v-model="input.start">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Expire On <label class="text-danger">*</label></label>
              <input type="datetime-local" class="form-control" v-model="input.end">
            </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createCouponModal">Cancel</button>
              <button type="button" class="btn btn-primary" @click="submit()">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
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
      input: {
        account_id: null,
        code: null,
        description: null,
        type: null,
        value: null,
        start: null,
        end: null
      }
    }
  },
  props: ['params'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    submit(){
      if(this.validate()){
        this.input.account_id = this.user.userID
        this.APIRequest('coupons/create', this.input).then(response => {
          if(response.data > 0){
            this.input.code = null
            this.input.description = null
            this.input.type = null
            this.input.value = null
            this.input.start = null
            this.input.end = null
            $('#createCouponModal').modal('hide')
            this.$parent.retrieve()
          }
        })
      }
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: this.user.userID,
          column: 'account_id',
          clause: '='
        }]
      }
      this.APIRequest('coupons/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data
        }else{
          this.data = null
        }
      })
    },
    validate(){
      let t = this.input
      if(t.code !== null || t.code !== '' || t.type !== null || t.type !== '' || t.value !== null || t.value !== '' || t.start !== '' || t.start !== '' || t.end !== '' || t.end !== ''){
        return true
      }
      return false
    }
  }
}
</script>
