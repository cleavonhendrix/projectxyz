<template>
  <div>
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#createProductModal"><i class="fa fa-plus"></i> Add New Product</button>

      <div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Sell something on <b><b>CLASS</b></b>WORX</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text-white">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span v-if="errorMessage !== null" class="text-danger text-center">
                <label><b>Opps! </b>{{errorMessage}}</label>
            </span>
            <br v-if="errorMessage !== null">
            <div class="form-group">
              <input type="text" class="form-control" v-model="newProduct.title" placeholder="What are you selling?">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" v-model="newProduct.price" placeholder="Price">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" v-model="newProduct.location" placeholder="Add Location">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary dropdown-toggle mr-sm-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Related College</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">General</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Law</a>
                  <a class="dropdown-item" href="#">Arts & Sciences</a>
                  <a class="dropdown-item" href="#">Nursing</a>
                  <a class="dropdown-item" href="#">Commerce</a>
                  <a class="dropdown-item" href="#">Engineering</a>
                  <a class="dropdown-item" href="#">Pharmacy</a>
                  <a class="dropdown-item" href="#">Architecture & Fine Arts</a>
                  <a class="dropdown-item" href="#">Education</a>
                </div>
              </div>
              <input type="text" class="form-control my-2 my-sm-0" placeholder="Enter specific course or program (Optional)">
            </div>

            <div class="form-group">
              <textarea class="form-control" v-model="newProduct.description" placeholder="Item description (optional)" rows="3">
              </textarea> 
            </div>

            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile" @change="onFileSelected">
                <button class="btn btn-warning mr-sm-2" type="button" for="inputGroupFile">Choose Multiple Images
                </button>
              </div>
              <div class="input-group-prepend">
                <button class="btn btn-primary mr-sm-2" type="button">Upload Now</button>
              </div>
            </div>



            <div class="form-group">
              <select v-model="newProduct.status" class="form-control">
                <option value="not_verified">Don't get verification</option>
                <option value="verified">Get verification (takes longer to post)</option>
              </select>
            </div>

          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="submit()">Submit</button>
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
