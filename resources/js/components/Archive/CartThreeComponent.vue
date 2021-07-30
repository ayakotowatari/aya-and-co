<template>
<div>
     <div class="lg:w-2/3 w-full mx-auto mt-8 overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">Item</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Price</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in cart" :key="item.id">
                        <td class="p-4" v-text="item.name"></td>
                        <td class="p-4" v-text="item.quantity"></td>
                        <td class="p-4" v-text="cartLineTotal(item)"></td>
                        <td class="w-10 text-right">
                            <button
                                class="flex ml-auto text-sm text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                                @click="$store.commit('removeFromCart', index)"
                            >Remove</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-4 font-bold">Total Amount</td>
                        <td class="p-4 font-bold" v-text="cartQuantity"></td>
                        <td class="p-4 font-bold" v-text="cartTotal"></td>
                        <td class="w-10 text-right"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <v-container>
    <v-form>
      <v-row justify="center">
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="customer.first_name"
            :rules="nameRules"
            :counter="10"
            label="First name"
            required
            :disabled="paymentProcessing"
          ></v-text-field>
        </v-col>
    </v-row>
    <v-row justify="center">
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="customer.last_name"
            :rules="nameRules"
            :counter="10"
            label="Last name"
            required
            :disabled="paymentProcessing"
          ></v-text-field>
        </v-col>
    </v-row> 
    <v-row justify="center">          
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="customer.email"
            :rules="emailRules"
            label="E-mail"
            required
            :disabled="paymentProcessing"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row justify="center">
          <v-col cols=12 sm=12 md=4>
            <div class="flex flex-wrap -mx-2 mt-4">
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="card-element" class="card-info-title">クレジットカード情報</label>
                        <div id="card-element" class="card-element"></div>
                        <div id="card-error" v-if="cardError">{{ cardError }}</div>
                    </div>
                </div>
            </div>
        </v-col>
      </v-row>
        <v-btn
            @click="processPayment"
        >
            Pay Now
        </v-btn>
        <v-btn
            @click="processPaymentAsGuest"
        >
            Pay Now as Guest
        </v-btn>
  </v-form>
  </v-container>
   
</div>
</template>

<script>

import { mapState } from 'vuex';
import { loadStripe } from '@stripe/stripe-js';

export default {
    data: function(){
        return {
            // id: this.$route.params.id
            stripe: {},
            cardElement: {},
            cardError: null,
            message: "",
            products: {},
            customer: {
                first_name: '',
                last_name: '',
                email: '',
            },
            nameRules: [
                v => !!v || 'Name is required',
                v => v.length <= 10 || 'Name must be less than 10 characters',
            ],       
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid',
            ],
            paymentProcessing: false
        }
    },
    async mounted(){
        this.stripe = await loadStripe('pk_test_51J0LDyHqbknAxatFaAwlCUX9kBQ0Pm1y8vxHS7HfavGtjQoUzUcqdlCYHa94F5JZXhZKIiOVfXknzPHey45W9DR600Zv4O4onO');

        const elements = this.stripe.elements();
        this.cardElement = elements.create('card', {
            // classes: {
            //         base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            //     },
            style: {
                base: {
                    color: "#32325D",
                    fontWeight: 500,
                    fontFamily: "Inter, Open Sans, Segoe UI, sans-serif",
                    fontSize: "16px",
                    fontSmoothing: "antialiased",

                    "::placeholder": {
                    // color: "#CFD7DF"
                    color: "#262626"
                    }
                },
                invalid: {
                    color: "#E25950"
                }
            },
            hidePostalCode: true
            });
            this.cardElement.mount('#card-element');

            this.listenForErrors();

            // this.cardElement.on('change', function(event) {
            //     var displayError = document.getElementById('card-errors');
            //     if (event.error) {
            //         displayError.textContent = event.error.message;
            //     } else {
            //         displayError.textContent = '';
            //     }
            // });
    },
    computed: {
        ...mapState([
          'cart'
        ]),
        cartQuantity(){
            return this.$store.state.cart.reduce((acc,item) => acc + item.quantity, 0);
        },
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
    },
    methods: {
        cartLineTotal(item) {
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        // errorMessage(){
        //     this.card.addEventListener('change', (event) => {
        //         this.cardError = event.error ? event.error.message:null;
        //     });
        // },
        listenForErrors(){
            const vm = this;

            this.cardElement.addEventListener('change', (event)=>{
                vm.cardError = event.error ? event.error.message: null;
            })
        },
        async processPayment(){
            
            this.paymentProcessing = true;

            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: {
                        name: this.customer.first_name + ' ' + this.customer.last_name,
                        email: this.customer.email
                    }
                }
            );

            if(error) {
                this.paymentProcessing = false; 
                this.cardError = error.message;
                console.error(error);
            }else{
                console.log(paymentMethod);
                this.customer.payment_method_id = paymentMethod.id;
                this.customer.amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                this.customer.cart = JSON.stringify(this.$store.state.cart);
            }

            axios.post('/purchase', this.customer)
            .then((response) => {
                this.paymentProcessing = false;
                console.log(response);

                this.$store.commit('updateOrder', response.data);
                this.$store.dispatch('clearCart');
            })
        },
        async processPaymentAsGuest(){
            
            this.paymentProcessing = true;

            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: {
                        name: this.customer.first_name + ' ' + this.customer.last_name,
                        email: this.customer.email
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

            axios.post('/guest-purchase', this.customer)
            .then((response) => {
                this.paymentProcessing = false;
                console.log(response);

                this.$store.commit('updateOrder', response.data);
                this.$store.dispatch('clearCart');
            })
        }

    }
}
</script>

<style>
.card-info-title {
    color: rgba(0,0,0,.6);
}
.card-element {
    margin-top: 10px;
    border: 0.5px solid;
    border-color: rgba(0,0,0,.6);
    padding: 10px;
}
</style>