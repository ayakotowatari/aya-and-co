<template>
  <v-container>
        <thankyouguest-component
            v-bind:dialog='dialog'
            v-bind:guest='guest'
        ></thankyouguest-component>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                {{guest.name}} 様のご購入手続き
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <span>
                    合計金額（税込・送料別）：
                </span>
                <span v-text="cartTotal"></span>
            </v-col>
        </v-row>
        <v-form>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="4">
                    <label for="card-number" class="card-info-title">カード番号</label>
                    <!-- <div id="card-element"></div> -->
                    <div class="card-info" id="card-number"></div>
                    <v-divider></v-divider>
                    <div id="card-error" v-if="cardNumberError">{{ cardNumberError }}</div>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="4">
                    <label for="card-expiry" class="card-info-title">有効期限</label>
                    <div class="card-info" id="card-expiry"></div>
                    <v-divider></v-divider>
                    <div id="card-error" v-if="cardExpiryError">{{ cardExpiryError }}</div>
                </v-col>
            </v-row>
        
            <v-row justify="center">
                <v-col cols="12" sm="12" md="4">
                    <label for="card-cvc" class="card-info-title">3桁のセキュリティコード</label>
                    <div class="card-info" id="card-cvc"></div>
                    <v-divider></v-divider>
                    <div id="card-error" v-if="cardCvcError">{{ cardCvcError }}</div>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols=12 sm=12 md=2>
                    <v-btn
                        @click="processPaymentAsGuest"
                        :loading="loading"
                    >
                    支払いをする
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
        {{message}}
  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import ThankYou from './ThankYouGuestDialogComponent'

import { loadStripe } from '@stripe/stripe-js';

export default {
    component: {
        ThankYou,
    },
    data: function(){
        return{
            stripe: {},
            // cardElement: {},
            cardNumber: {},
            cardExpiry: {},
            cardCvc: {},
            cardNumberError: null,
            cardExpiryError: null,
            cardCvcError: null,
            message: "",
            customer: {
                name: '',
                email: '',
                address: '',
                city: '',
                state: '',
                zip_code: '',
                address_id: '',
                delivery_time: '',
            },
            paymentProcessing: false,
            loading: false,
        }
    
    },
    async mounted(){
        this.stripe = await loadStripe('pk_test_51J0LDyHqbknAxatFaAwlCUX9kBQ0Pm1y8vxHS7HfavGtjQoUzUcqdlCYHa94F5JZXhZKIiOVfXknzPHey45W9DR600Zv4O4onO');

        let elements = this.stripe.elements();
       
        let elementStyles = {
            base: {
                color: "#32325D",
                fontWeight: 500,
                fontFamily: "Inter, Open Sans, Segoe UI, sans-serif",
                fontSize: "16px",
                fontSmoothing: "antialiased",

                "::placeholder": {
                // color: "#CFD7DF"
                color: "#717171",
                }
            },
            invalid: {
                color: "#E25950"
            }
        };

        let elementClasses = {
            focus: 'focus',
            empty: 'empty',
            invalid: 'invalid',
        };

        this.cardNumber = elements.create('cardNumber', {
            // classes: {
            //       base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            // }       
            style: elementStyles,
            classes: elementClasses,
        });
        this.cardNumber.mount('#card-number');

        this.listenForErrorsCardNumber();

        this.cardExpiry = elements.create('cardExpiry', {
            style: elementStyles,
            classes: elementClasses,
            // classes: {
            //       base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            // } 
        });
        this.cardExpiry.mount('#card-expiry');

        this.listenForErrorsCardExpiry();

        this.cardCvc = elements.create('cardCvc', {
            style: elementStyles,
            classes: elementClasses,
            // classes: {
            //       base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            // } 
        });
        this.cardCvc.mount('#card-cvc');

        this.listenForErrorsCardCvc();

        // registerElements([this.cardNumber, this.cardExpiry, this.cardCvc], 'card');
    },
    created(){

    },
    computed: {
        ...mapState([
            'cart',
            'guest',
            'deliveryAddress',
            'dialog',
        ]),
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
    },
    methods: {
        ...mapActions([
            'clearCart',
        ]),
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        listenForErrorsCardNumber(){
            const vm = this;

            this.cardNumber.addEventListener('change', (event)=>{
                vm.cardNumberError = event.error ? event.error.message: null;
            })
        },
        listenForErrorsCardExpiry(){
            const vm = this;

            this.cardExpiry.addEventListener('change', (event)=>{
                vm.cardExpiryError = event.error ? event.error.message: null;
            })
        },
        listenForErrorsCardCvc(){
            const vm = this;

            this.cardCvc.addEventListener('change', (event)=>{
                vm.cardCvcError = event.error ? event.error.message: null;
            })
        },
        async processPaymentAsGuest(){
            
            this.paymentProcessing = true;
            this.loading = true;

            this.customer.name = this.guest.name;
            this.customer.email = this.guest.email;
            this.customer.address = this.guest.address_1 + ' ' + this.guest.building;
            this.customer.city = this.guest.city;
            this.customer.state = this.guest.prefecture;
            this.customer.zip_code = this.guest.zipcode;
            // this.customer.address_id = this.guest.id;
            this.customer.delivery_time = this.deliveryAddress.delivery_time;
            this.customer.delivery_address = this.deliveryAddress.id;


            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                'card', this.cardNumber, {
                    billing_details: {
                        name: this.customer.name,
                        email: this.customer.email,
                        address: {
                            line1: this.customer.address,
                            city: this.customer.city,
                            state: this.customer.prefecture,
                            zipcode: this.customer.zipcode,
                        }
                    }
                }
            );

            if(error) {
                this.paymentProcessing = false; 
                console.error(error);
            }else{
                console.log(paymentMethod);
                this.customer.payment_method_id = paymentMethod.id;
                this.customer.amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                this.customer.cart = JSON.stringify(this.$store.state.cart);
            }

            axios.post('/guest/purchase', this.customer)
            .then((response) => {
                this.paymentProcessing = false;
                console.log(response);

                this.$store.commit('updateOrder', response.data);
                this.$store.dispatch('clearCart');
                this.$store.dispatch('clearDeliveryAddress');
                this.loading = false;
                this.$store.dispatch('showDialog');
                // this.$router.push({ name: 'order-summary'})
            })
            .catch((error) => {
                this.paymentProcessing = false;
                this.loading = false;
                console.error(error);
                this.message = error.response.data.message;
            })
        },
    },

}
</script>

<style>

</style>