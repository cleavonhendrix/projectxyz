<template>
  <div>
      <div class="modal fade" id="buyNow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title" id="exampleModalLabel">Enter shipping information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text-white">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span v-if="errorMessage !== null" class="text-danger text-center">
                <label><b>Opps! </b>{{errorMessage}}</label>
            </span>
            <br v-if="errorMessage !== null">
              <div class="row form-group">
                <div class="col">
                  <input type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Last name">
                </div>
              </div>
            <div class="row form-group">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Email address (example@marketplace.com)">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Mobile number (+63)">
                </div>
              </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Please enter your House Number, Building and Street Name">
            </div>
            <div class="row form-group">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Province">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="City/Municipality">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Barangay">
                </div>
              </div>

          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success">Proceed to Check-out</button>
        </div>
        </div>
      </div>
    </div>
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
      newProduct: {
        account_id: null,
        title: null,
        description: null,
        sku: null,
        status: 'not_verified'
      },
      errorMessage: null
    }
  },
  props: ['params'],
  methods: {
    onFileSelected(event){
      console.log(event)
    },
    redirect(parameter){
      ROUTER.push(parameter)
    },
    submit(){
      if(this.validate()){
        this.newProduct.account_id = this.user.userID
        this.APIRequest('/products/create', this.newProduct).then(response => {
          console.log(response)
        })
      }
    },
    validate(){
      let i = this.newProduct
      if((i.title !== '' || i.title !== null)){
        this.errorMessage = null
        return true
      }else{
        this.errorMessage = 'Please fill in all required fields.'
        return false
      }
    }
  }
}
</script>
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
