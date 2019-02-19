<template>
  <div>
    <div class="modal fade" id="applyPartnerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Apply Printing Code</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text-white">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span v-if="errorMessage !== null" class="text-danger text-center">
                <label><b>Opps! </b>{{errorMessage}}</label>
            </span>
            <br>
            <div class="form-group">
              <label for="exampleInputEmail1">Printing Code <label class="text-danger">*</label></label>
              <input type="text" class="form-control" placeholder="Type code here..." v-model="code">
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#applyPartnerModal">Close</button>
              <button type="button" class="btn btn-primary" @click="retrieve()">Apply</button>
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
      code: null
    }
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    retrieve(){
      let parameter = {
        condition: [{
          value: this.code,
          column: 'code',
          clause: '='
        }]
      }
      this.APIRequest('accounts/retrieve', parameter).then(response => {
        if(response.data.length > 0){
          this.data = response.data
          this.$parent.partner = response.data[0]
          this.$parent.managePartner()
        }else{
          this.data = null
        }
      })
    }
  }
}
</script>
