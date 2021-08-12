<template>
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
                                        <v-col cols="4" sm="4" md="4" >
                                            <label for="">数量</label>
                                        </v-col>
                                        <v-col cols="2" sm="2" md="4">
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
            </v-row>
        </div>
        <div class="divider-image orange-image">
         <v-img
             max-width=120
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/orange.png"
          ></v-img>
        </div>
        <div class="subheading">
        Products List
        </div>
        <div class="subheading-jp">
            商品ラインナップ
        </div>
        <v-row>
            <v-col cols="12" sm="12" md="3" v-for="category in categories" :key="category.id">
                <v-card
                    class="mx-auto"
                    max-width="344"
                    outlined
                    
                >
                    <v-img
                        max-height="200"
                        :src="category.absolute_path"
                    > 
                    </v-img>
                    <v-card-text>
                        <div class="product-name mb-1">
                            {{category.name}}
                        </div>
                        <div class="product-season mb-4">
                            {{category.season}}
                        </div>
                        <!-- <div class="product-size mb-2">
                        {{product.size}}
                        </div> -->
                        <!-- <div class="product-price mb-4">
                            {{formatPrice(product.price)}}
                        </div> -->
                        <div class="product-details">
                            {{category.details}}
                        </div>
                    </v-card-text>

                    <!-- <v-list-item three-line>
                    <v-list-item-content>
                        <div class="product-name mb-1">
                        {{product.name}}
                        </div>
                        <div class="product-size mb-4">
                        {{product.size}}
                        </div>
                        <div class="product-price mb-6">
                            {{formatPrice(product.price)}}
                        </div>
                        <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar
                        tile
                        size="80"
                        color="grey"
                    ></v-list-item-avatar>
                    </v-list-item>
                    -->
                    <div class="link">
                        <router-link
                            :to="{
                            name: 'products',
                            params: {id: category.id}
                            }"
                            @click.native="scrollToTop"
                        >
                            <v-card-actions>
                            <v-btn
                                outlined
                                rounded
                                text
                                @click.prevent="expand(category.id)"          >
                                詳細
                            </v-btn>
                            </v-card-actions>
                        </router-link>
                    </div>
                </v-card>
            </v-col>
        </v-row>
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
            quantity: [1, 2, 3]
        }
    },
    mounted(){
        
    },
    computed: {
        ...mapState([
          'cart',
          'categories',
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