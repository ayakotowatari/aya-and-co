<template>
    <v-container>
        <updatecartquantitydialog-component
            v-bind:dialogUpdateCartQuantity='dialogUpdateCartQuantity'
            v-bind:selectableNumbers='selectableNumbers'
        ></updatecartquantitydialog-component>
        <removecartitemdialog-component
            v-bind:dialogRemoveCartItem='dialogRemoveCartItem'
        ></removecartitemdialog-component>
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
        <div v-if="cart.length <= 0" class="jp-font-400 grey--text text--darken-2 mb48">
            お買い物かごに何も入っていません。
        </div>
        <div v-if="cart.length >= 1" class="mb48">
            <v-row>
                <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

                </v-col>
                <v-col cols="12" sm="12" md="8">
                    <v-row justify="start">
                        <v-col cols="12" sm="12" md="6" v-for="(item) in cart" :key="item.id">
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
                                        <v-col cols="4" sm="4" md="3" >
                                            <label for="">数量</label>
                                        </v-col>
                                        <v-col cols="2" sm="2" md="2">
                                            <!-- <select :value="`${item.quantity}`" class="select-box" @change="updateCartQuantity(index, $event.target.value)">
                                                <option value=1>1</option>
                                                <option value=2>2</option>
                                                <option value=3>3</option>
                                                <option value=4>4</option>
                                                <option value=5>5</option>
                                                <option value=6>6</option>
                                                <option value=7>7</option>
                                                <option value=8>8</option>
                                                <option value=9>9</option>
                                            </select> -->
                                                {{ item.quantity }}
                                        </v-col>
                                        <!-- <v-col cols="2" sm="2" md="2">
                                             <v-btn
                                                text
                                                color="primary"
                                            >
                                                <v-icon
                                                >
                                                mdi-plus-minus-variant
                                                </v-icon>
                                            </v-btn>
                                        </v-col> -->
                                    </v-row>
                                    <div class="text-overline mb-4">
                                    小計: {{ cartLineTotal(item) }}（税込）
                                    </div>
                                    <v-row>
                                        <v-col cols="4" sm="4" md="4" class="mr-6">
                                            <v-btn
                                                outlined
                                                color="grey darken-1"
                                                @click="updateCartQuantity(item)"
                                            >
                                                <!-- <v-icon
                                                >
                                                mdi-plus-minus-variant
                                                </v-icon> -->
                                                数量変更
                                            </v-btn>
                                        </v-col>
                                        <v-col cols="4" sm="4" md="4">
                                            <v-btn
                                                outlined
                                                color="grey darken-1"
                                                @click="remove(item)"
                                            >
                                                <!-- <v-icon
                                                >
                                                mdi-trash-can-outline
                                                </v-icon> -->
                                                削除
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    tile
                                    size="80"
                                    color="grey"
                                >
                                    <v-img
                                        :src="`https://s3-ap-northeast-1.amazonaws.com/aya-and-co/${item.image}`"
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
                                @click="goToProductsList"
                                class="hidden-sm-and-down"
                            >お買いものを続ける</v-btn>
                            <v-btn
                                block
                                color="primary"
                                outlined
                                @click="goToProductsList"
                                class="hidden-md-and-up"
                            >お買いものを続ける</v-btn>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </div>
        <div class="divider-image orange-image">
         <v-img
             max-width=90
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/orange.png"
          ></v-img>
        </div>

        <div class="subheading">
            Products List
        </div>
        <div class="subheading-jp">
            商品リスト
        </div>

        <v-tabs v-model="tab" class="mb-12">
          <v-tab
              href="#tab-1"
          >
              全ての商品
          </v-tab>
          <v-tab
              href="#tab-2"
          >
              いま販売中の商品
          </v-tab>
          <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
      </v-tabs>

      <v-tabs-items v-model="tab">
          <v-tab-item 
              value="tab-1"
          >
              <allproducts-component></allproducts-component>
          </v-tab-item>
          <v-tab-item
              value="tab-2"
          >
              <currentproducts-component></currentproducts-component>
          </v-tab-item>
      </v-tabs-items>
   </v-container>
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
            tab: null,
            // quantity: [1, 2, 3]
        }
    },
    mounted(){
        
    },
    created(){
        
    },
    computed: {
        ...mapState([
          'cart',
          'categories',
          'dialogUpdateCartQuantity',
          'dialogRemoveCartItem',
          'selectableNumbers',
        ]),
        // formatPrice(){
        //   let amount = this.item.price;
        //   console.log(amount)

        //   return amount.toLocaleString('ja-JP', {style: 'currency', currency: 'JPY'});
        // },
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            //console.log(amount);
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
            'removeProduct',
            'openDialogUpdateCartQuantity', 
            'openDialogRemoveCartItem',
            'fetchInventory'
        ]),
        formatPrice(value){
          let amount = value;

          return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        updateCartQuantity(value){
            // this.$store.commit('openDialogUpdateCartQuantity', id)
            this.openDialogUpdateCartQuantity({
                cartItem: value
            })
            this.fetchInventory({
                product_id: value.id
            })
        },
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        // remove(value){

        //     console.log('slug', value)

        //     this.removeProduct({
        //         slug: value
        //     })

        // },
        remove(value){

            //console.log(value);

            this.openDialogRemoveCartItem({
                cartItem: value
            })
            // console.log('id', value)

            // this.removeProduct({
            //     slug: value
            // })

        },
        // backToHome(){
        //     this.$router.push({name: 'home'})
        // },
        goToProductsList(){
            this.$router.push({name: 'products-list'})
        },
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        // updateCartQuantity(index, value){
        //     this.$store.commit('updateCartQuantity', {index, value})
        // },
        expand(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
    }
}
</script>

<style>
.item-quantity{
    border: 1px solid;
}

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

@media(max-width:780px){
   .orange-image{
       max-width: 70px;
   }
}

</style>