<template>
    <v-container>
        <checkoutsnackbar-component
            v-bind:checkoutError="checkoutError"
        ></checkoutsnackbar-component>
        <thankyou-component
            v-bind:dialogThankYou='dialogThankYou'
            v-bind:user='user'
        ></thankyou-component>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Order
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    ご購入の手続き
                  </div>
              </div>
          </v-col>
        </v-row>
        <div v-if="cart.length <= 0">
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="jp-font-400 grey--text text--darken-2">カートに商品が入っておりません。</div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <v-btn
                        outlined
                        color="primary"
                        @click="$router.push({name: 'products-list'})"
                    >お買いものを続ける</v-btn>
                </v-col>
            </v-row>
        </div>
        <v-stepper v-model="e1" v-if="cart.length >= 1">
            <v-stepper-header>
                <v-stepper-step
                    :complete="e1 > 1"
                    step="1"
                >
                    配送先住所の選択
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step
                    :complete="e1 > 2"
                    step="2"
                >
                    配送オプション等の選択
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step
                    :complete="e1 > 3"
                    step="3"
                >
                    注文内容の確認
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step step="4">
                    お支払い
                </v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
                <v-stepper-content step="1">
                    <checkaddress-component></checkaddress-component>
                    <v-row justify="end">
                        <v-col cols="4" sm="4" md="2">
                            <v-btn
                                block
                                color="primary"
                                @click="nextTo2"
                                :disabled="disableContinue1"
                                >
                                次へ
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>

                <v-stepper-content step="2">
                    <deliveryoption-component
                        v-bind:deliveryAddress='deliveryAddress'
                    ></deliveryoption-component>
                    <v-row justify="space-between" class="hidden-sm-and-down">
                        <v-col cols="5" sm="5" md="1">
                            <v-btn
                                outlined
                                color="primary"
                                @click="backTo1"
                                >
                                戻る
                            </v-btn>
                        </v-col>
                        <v-col cols="4" sm="4" md="2">
                            <v-btn
                                block
                                color="primary"
                                @click="nextTo3"
                                :disabled="disableContinue2"
                                >
                                次へ
                            </v-btn>
                        </v-col>
                    </v-row>
                     <v-row justify="space-between" class="hidden-md-and-up">
                        <v-col cols="3" sm="3" md="2">
                            <v-btn 
                                color="primary"
                                outlined
                                @click="backTo1"
                            >
                                戻る
                            </v-btn>
                        </v-col>
                        <v-col cols="4" sm="4" md="2">
                            <v-btn
                                block
                                color="primary"
                                @click="nextTo3"
                                :disabled="disableContinue2"
                                >
                                次へ
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>

                <v-stepper-content step="3">
                    <orderconfirmation-component
                        v-bind:deliveryAddress='deliveryAddress'
                    ></orderconfirmation-component>
                    <v-row justify="space-between" class="hidden-sm-and-down">
                        <v-col cols="5" sm="5" md="1">
                            <v-btn
                                outlined
                                color="primary"
                                @click="backTo2"
                                >
                                戻る
                            </v-btn>
                        </v-col>
                        <v-col cols="5" sm="5" md="2">
                            <v-btn
                                color="primary"
                                @click="nextTo4"
                                >
                                レジへ進む
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row class="hidden-md-and-up">
                        <v-col cols="12" sm="12" md="2">
                            <v-btn
                                block
                                dark
                                color="primary"
                                @click="nextTo4"
                                >
                                レジへ進む
                            </v-btn>
                        </v-col>
                        <v-col cols="3" sm="3" md="2">
                            <v-btn 
                                color="primary"
                                outlined
                                @click="backTo2"
                            >
                                戻る
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-stepper-content>

                <v-stepper-content step="4">
                    <checkout-component
                        v-bind:deliveryAddress='deliveryAddress'
                    ></checkout-component>
                    <v-row class="hidden-sm-and-down">
                        <v-col cols="5" sm="5" md="1">
                            <v-btn
                                outlined
                                color="primary"
                                @click="backTo3"
                                >
                                戻る
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row class="hidden-md-and-up">
                        <v-col cols="3" sm="3" md="1">
                            <v-btn
                                outlined
                                color="primary"
                                @click="backTo3"
                                >
                                戻る
                            </v-btn>
                        </v-col>
                    </v-row>

                    <!-- <v-btn
                    color="primary"
                    @click="e1 = 1"
                    >
                    Continue
                    </v-btn>

                    <v-btn text>
                    Cancel
                    </v-btn> -->
                </v-stepper-content>
            </v-stepper-items>
        </v-stepper>
    </v-container>
</template>
<script>
import { mapState, mapActions } from 'vuex';

// import CheckAddress from './CheckAddressComponent'
// import OrderConfirmation from './OrderConfirmationComponent'
// import Checkout from './CheckoutComponent'

export default {
    component: {
        // CheckAddress,
        // OrderConfirmation,
        // Checkout
    },
    data: function(){
        return {
            e1: 1,
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'disableContinue1', 
            'disableContinue2',
            'deliveryAddress',
            'cart',
            'checkoutError',
            'dialogThankYou',
            'user'
        ])
    
    },
    methods: {
        nextTo2(){
            this.e1 = 2;
            window.scrollTo(0,0);
            this.$store.commit('updateDisableContinue1', true);
            this.$store.commit('setDisabled', false);
        },
        backTo1(){
            this.e1 = 1;
            window.scrollTo(0,0);
            this.$store.commit('updateDisableContinue1', true);
            this.$store.commit('setDisabled', false);
        },
        nextTo3(){
            this.e1 = 3;
            window.scrollTo(0,0);
            this.$store.commit('updateDisableContinue2', true);
            this.$store.commit('setDisabled', false);
        },
        backTo2(){
            this.e1 = 2;
            window.scrollTo(0,0);
            this.$store.commit('updateDisableContinue2', true);
            this.$store.commit('setDisabled', false);
        },
        nextTo4(){
            this.e1 = 4
            window.scrollTo(0,0);
        },
        backTo3(){
            this.e1 = 3;
            window.scrollTo(0,0);
        }

     
        
    }


}
</script>

<style>

</style>