<template>
  <div>
    <div class="modal fade" id="creditCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Credit Card</h5>
            <button type="button" class="close" @click="hideModal()" aria-label="Close">
              <span aria-hidden="true" class="text-white">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span class="inputs">
              <span class="input-group text-primary" style="font-size: 32px;">
                <i class="fa fa-cc-visa"></i>
                <i class="fa fa-cc-mastercard"></i>
                <i class="fa fa-cc-diners-club"></i>
                <i class="fa fa-cc-amex"></i>
                <i class="fa fa-cc-jcb"></i>
                <i class="fa fa-cc-discover"></i>
              </span>
              <div :class="{complete}" class="">
                <div class="form-group">
                  <label for="address">Card Number</label>
                  <card-number class="stripe-element card-number"
                    ref="cardNumber"
                    :stripe="stripeSK"
                    @change="number = $event.complete"
                    :options="options"
                  />
                </div>

                <div class="form-group">
                  <label for="address">Expiration</label>
                  <card-expiry class="stripe-element card-expiry"
                    ref="cardExpiry" 
                    :stripe="stripeSK" 
                    @change="expiry = $event.complete"
                    :options="options"
                  />
                </div>

                <div class="form-group">
                  <label for="address">CVC</label>
                    <card-cvc class='stripe-element card-cvc'
                      ref='cardCvc'
                      :stripe="stripeSK" 
                      @change="cvc = $event.complete" 
                      :options="options"
                    />
                  </div>
              </div>
            </span>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="hideModal()">Cancel</button>
              <button class="btn btn-primary" @click="createCustomer()">Proceed</button>
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
.input-group i{
  padding-right: 2px;
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
.stripe-element{
  height: 45px;
  display: block;
  width: 100%;
  padding: .90rem .75rem;
  font-size: 12px;
  background-color: #fff;
  background-image: none;
  background-clip: padding-box;
  border: 1px solid rgba(0,0,0,.15);
  border-radius: .25rem;
  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

.stripe-element .card-number, .stripe-element .card-expiry, .stripe-element .card-cvc{
  padding: 0px;
}

.StripeElement{
  padding: .90rem .75rem;
  color: #495057;
  line-height: 1.25;
}
</style>
<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
import OPKEYS from '../../payment.js'
import CardExpiry from '../../components/stripe/CardExpiry'
import CardCvc from '../../components/stripe/CardCvc'
import CardNumber from '../../components/stripe/CardNumber'
import { Stripe } from '../../components/stripe/stripeElements'
export default {
  data(){
    return {
      user: AUTH.user,
      config: CONFIG,
      complete: false,
      number: false,
      expiry: false,
      cvc: false,
      stripeSK: (OPKEYS.flag === false) ? OPKEYS.stripe.dev_pk : OPKEYS.stripe.live_pk,
      options: {
      }
    }
  },
  components: {
    CardExpiry,
    CardCvc,
    CardNumber
  },
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    },
    hideModal(){
      $('#creditCardModal').modal('hide')
    },
    createCustomer(){
      $('#loading').css({'display': 'block'})
      Stripe.createSource().then(data => {
        if(data.error !== undefined){
          $('#loading').css({'display': 'none'})
          // console.log(data.error)
          this.errorMessage = data.error.message
        }else{
          let parameter = {
            email: this.user.email,
            source: data.source,
            account_id: this.user.userID,
            name: 'Kennette Canales',
            payment_keys: OPKEYS
          }
          this.APIRequest('stripes/create', parameter).then(response => {
            if(response.data > 0){
              $('#loading').css({'display': 'none'})
              this.hideModal()
              this.$parent.updateStripeExpress(response.data)
            }
          })
        }
      })
    }
  }
}
</script>
