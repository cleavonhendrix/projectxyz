<template>
  <div id="updateCoupons">
    <div class="modal fade" id="updateCouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-if="item !== null">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Update Coupon</h5>
            <button type="button" class="close" @click="close()" aria-label="Close">
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
              <input type="text" class="form-control" placeholder="Type code here..." v-model="item.code">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <input type="text" class="form-control" placeholder="Type description here..." v-model="item.description">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Type <label class="text-danger">*</label></label>
              <select class="form-control" v-model="item.type" disabled>
                <option value="percentage">Percentage</option>
                <option value="fixed_amount">Fixed Amount</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Value</label>
              <input type="text" class="form-control" placeholder="Type value here..." v-model="item.value" disabled>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Start On <label class="text-danger">*</label></label>
              <input type="datetime-local" class="form-control" v-model="item.start">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Expire On <label class="text-danger">*</label></label>
              <input type="datetime-local" class="form-control" v-model="item.end">
            </div>
          </div>
          <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger pull-left" @click="deleteItem()">Delete</button> -->
              <button type="button" class="btn btn-danger" @click="close()">Cancel</button>
              <button type="button" class="btn btn-primary" @click="update()">Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.featured-image{
  width: 100%;
  float: left;
  height: 200px;
  margin-bottom: 10px;
}

.featured-image .options{
  width: 100%;
  float: left;
  text-align: center;
  height: 200px;
  border: solid 1px #ddd;
  overflow-y: hidden;
}
.options input{
  display: none;
}
.options:hover{
  cursor: pointer;
}
.options i{
  font-size: 40px;
  width: 100%;
  float: left;
  margin-top: 75px;
}

.options label{
  width: 100%;
  float: left;
}
.options img{
  width: 100%;
  float: left;
  height: auto;
}
</style>
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
      errorMessage: null,
      item: null
    }
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    update(){
      if(this.validate()){
        this.APIRequest('coupons/update', this.item).then(response => {
          if(response.data > 0){
            $('#updateCouponModal').modal('hide')
            this.$parent.retrieve()
          }
        })
      }
    },
    validate(){
      let t = this.item
      if(t.code !== null || t.code !== '' || t.type !== null || t.type !== '' || t.value !== null || t.value !== '' || t.start !== '' || t.start !== '' || t.end !== '' || t.end !== ''){
        return true
      }
      return false
    },
    close(){
      this.item = null
      $('#updateCouponModal').modal('hide')
    },
    modal(){
      $('#updateCouponModal').modal('show')
    },
    deleteItem(){
      if(this.item !== null){
        let parameter = {
          id: this.item.id
        }
        this.APIRequest('coupons/delete', this.item).then(response => {
          $('#updateCouponModal').modal('hide')
          this.$parent.retrieve()
        })
      }
    }
  }
}
</script>
