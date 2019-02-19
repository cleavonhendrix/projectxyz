<template>
  <div>
    <div class="modal fade" id="cancelPaypalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="exampleModalLabel">Payment Message</h5>
            <button type="button" class="close" @click="hideModal()" aria-label="Close">
              <span aria-hidden="true" class="text-white">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span class="text-center">
                <label>
                  You've cancelled your payment through paypal. If you encountered difficulties with the payment please contact us at support@idfactory.com.
                </label>
            </span>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="hideModal()">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>

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
.upload-image{
  height: 45px;
}
.upload-image:hover{
  cursor: pointer;
}
.upload-image input{
  display: none;
}
.preview{
  height: 100px;
  width: 100%;
  float: left;
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  data(){
    return {
      user: AUTH.user,
      config: CONFIG
    }
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    hideModal(){
      $('#cancelPaypalModal').modal('hide')
    }
  }
}
</script>
