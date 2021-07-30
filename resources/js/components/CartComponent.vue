<template>
<div>
    <v-container>
    
    <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Your Basket
                  </div>
                  <div v-if="user === null" class="page-subtitle grey--text text--darken-3">
                    お買い物かご
                  </div>
                  <div v-if="user !== null" class="page-subtitle grey--text text--darken-3">
                    {{user.name}}様のお買い物かご
                  </div>
              </div>
          </v-col>
      </v-row>
    <div v-if="cart.length <= 0" class="jp-font-400 grey--text text--darken-2">
        お買い物かごに何も入っていません。
    </div>
    <div v-if="cart.length >= 1">
    <v-row>
        <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

        </v-col>
        <v-col cols="12" sm="12" md="8">
             <v-row justify="start">
                <v-col cols="12" sm="12" md="6" v-for="(item, index) in cart" :key="item.id">
                    <v-card
                        class="mx-auto"
                        max-width="390"
                        outlined
                        color="#F1F1F1"
                    >
                        <v-list-item three-line>
                        <v-list-item-content>
                            <div class="product-name mb-1">
                                {{item.name}} 
                            </div>
                            <div class="product-size mb-4">
                                {{item.size}}
                            </div>
                            <div class="product-price mb-6">
                                {{formatPrice(item.price)}}
                                </div>
                            <v-row align="center">
                                <v-col cols="4" sm="4" md="4" >
                                    <label for="">数量</label>
                                </v-col>
                                <v-col cols="2" sm="2" md="4">
                                    <select :value="`${item.quantity}`" class="select-box" @change="updateCartQuantity(index, $event.target.value)">
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                        <option value=6>6</option>
                                        <option value=7>7</option>
                                        <option value=8>8</option>
                                        <option value=9>9</option>
                                    </select>
                                </v-col>
                            </v-row>
                            <div class="text-overline mb-4">
                            小計: {{ cartLineTotal(item) }}（税込）
                            </div>
                            <v-row>
                                <v-col cols="4" sm="4" md="4">
                                    <v-btn
                                        outlined
                                        text
                                        @click="remove(`${item.slug}`)"
                                    >削除する</v-btn>
                                </v-col>
                            </v-row>
                        </v-list-item-content>
                        <v-list-item-avatar
                            tile
                            size="80"
                            color="grey"
                        >
                            <v-img
                                src="../assets/img/IMG_9502.JPG"
                            ></v-img>
                        </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <span class="totalprice">
                        合計金額（税込・送料別）：
                    </span>
                    <span v-text="cartTotal" class="totalprice"></span>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="3">
                    <v-btn
                        dark
                        color="primary"
                        v-if='user === null'
                        @click="$router.push({name: 'guest-order'})"
                        class="hidden-sm-and-down"
                    >
                    購入する
                    </v-btn>
                    <v-btn
                        block
                        dark
                        color="primary"
                        v-if='user === null'
                        @click="$router.push({name: 'guest-order'})"
                        class="hidden-md-and-up"
                    >
                    購入する
                    </v-btn>
                    <v-btn
                        dark
                        color="primary"
                        v-if='user !== null'
                        @click="$router.push({name: 'order'})"
                        class="hidden-sm-and-down"
                    >
                    購入する
                    </v-btn>
                    <v-btn
                        block
                        dark
                        color="primary"
                        v-if='user !== null'
                        @click="$router.push({name: 'order'})"
                        class="hidden-md-and-up"
                    >
                    購入する
                    </v-btn>
                </v-col>
                <v-col cols="12" sm="12" md="3">
                    <v-btn
                        color="primary"
                        outlined
                        @click="backToHome"
                        class="hidden-sm-and-down"
                    >お買いものを続ける</v-btn>
                    <v-btn
                        block
                        color="primary"
                        outlined
                        @click="backToHome"
                        class="hidden-md-and-up"
                    >お買いものを続ける</v-btn>
                </v-col>
            </v-row>
        </v-col>
    <v-row>

  
  </v-row>
  </v-row>
  </div>
   </v-container>
   
</div>
</template>

<script>

import { mapState, mapActions } from 'vuex';

export default {
    props: {
        user: Object
    },
    data: function(){
        return {
            // id: this.$route.params.id
            quantity: [1, 2, 3]
        }
    },
    mounted(){
        
    },
    computed: {
        ...mapState([
          'cart'
        ]),
        // formatPrice(){
        //   let amount = this.item.price;
        //   console.log(amount)

        //   return amount.toLocaleString('ja-JP', {style: 'currency', currency: 'JPY'});
        // },
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        // selectedQuantity: {
        //     get(){
        //         return this.$store.state.cart[0].quantity
        //     },
        //     set (value) {
        //         this.$store.commit('updateCartQuantity', value)
        //     }
        // },
    },
    methods: {
        ...mapActions([
            'removeProduct'
        ]),
        formatPrice(value){
          let amount = value;

          return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        remove(value){

            console.log('slug', value)

            this.removeProduct({
                slug: value
            })

        },
        backToHome(){
            this.$router.push({name: 'home'})
        },
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        updateCartQuantity(index, value){
            this.$store.commit('updateCartQuantity', {index, value})
        },
    }
}
</script>

<style>
.select-box{
    border: solid 1px #bfbfbf; 
    border-radius: 5px;
    padding: 5px 8px;
}

.totalprice{
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    letter-spacing: 0.03em;
}

</style>