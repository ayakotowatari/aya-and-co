<template>
    <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Order Confirmation
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    ご注文内容の確認
                  </div>
              </div>
          </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" v-for="item in cart" :key="item.id">
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
                        <v-col cols="3" sm="3" md="4" >
                            <div>数量</div>
                        </v-col>
                        <v-col cols="3" sm="3" md="4">
                           <div>{{item.quantity}}</div>
                        </v-col>
                    </v-row>
                    <div class="text-overline mb-4">
                    小計: {{ cartLineTotal(item) }}（税込）
                    </div>
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
            <v-col cols="6" sm="6" md="2" class="py-1">
                <div class="totalprice grey--text text--darken-3">
                    商品小計（税込）
                </div>
            </v-col>
            <v-col cols="6" sm="6" md="2" class="py-1">
                <div v-text="cartTotal" class="totalprice">
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="6" sm="6" md="2" class="py-1">
                <div class="totalprice grey--text text--darken-3">
                    送料
                </div>
            </v-col>
            <v-col cols="6" sm="6" md="2" class="py-1">
                <div class="totalprice">
                    {{formatPrice(deliveryAddress.postage)}}
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <v-divider></v-divider>
            </v-col>
        </v-row>
         <v-row>
            <v-col cols="6" sm="6" md="2" class="py-1">
                <div class="charge grey--text text--darken-3">
                    ご請求額
                </div>
            </v-col>
            <v-col cols="6" sm="6" md="2" class="py-1">
                <div v-text="totalPrice" class="charge">
                </div>
            </v-col>
        </v-row>
        <v-row class="mb-4">
            <v-col cols="12" sm="12" md="4">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <h4 class="jp-font grey--text text--darken-3 mb24">お届け先のご住所等</h4>
        <v-row>
            <v-col>
                <v-card
                    class="mb24"
                    max-width="480"
                    outlined
                >
                    <v-list-item>
                        <v-list-item-content two-line>
                            <v-list-item-subtitle class="jp-font-400">
                                ご住所
                            </v-list-item-subtitle>
                            <v-list-item-title class="jp-font-400">
                                〒{{deliveryAddress.zipcode}}<br>
                                {{deliveryAddress.prefecture}}{{deliveryAddress.city}} {{deliveryAddress.address_1}}<br>
                            </v-list-item-title>
                            <v-list-item-title v-if="deliveryAddress.building !== null" class="jp-font-400">
                                {{deliveryAddress.building}}
                            </v-list-item-title>
                            <v-list-item-title class="jp-font-400">
                                {{deliveryAddress.name}}様
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-subtitle class="jp-font-400">
                                お電話番号
                            </v-list-item-subtitle>
                            <v-list-item-title class="jp-font-400">
                                {{deliveryAddress.phone}}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                     <v-list-item>
                        <v-list-item-content>
                            <v-list-item-subtitle class="jp-font-400">
                                ご希望の配達時間帯
                            </v-list-item-subtitle>
                            <v-list-item-title class="jp-font-400">
                                {{deliveryAddress.delivery_time}}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="2" class="hidden-sm-and-down">
                <v-btn
                    color="primary"
                    depressed
                    dark
                    @click="$router.push({name: 'checkout'})"
                >
                レジへ進む
                </v-btn>
            </v-col>
            <v-col cols="12" sm="12" md="2" class="hidden-sm-and-down">
                <v-btn
                    color="primary"
                    outlined
                    @click="$router.push({name: 'home'})"
                >お買い物を続ける</v-btn>
            </v-col>
        </v-row>
        <v-bottom-navigation class="hidden-md-and-up" background-color="primary" grow dark fixed app>
            <v-btn
                class="jp-font-400"
                @click="$router.push({name: 'checkout'})"
            >
                レジへ進む
            </v-btn>
        </v-bottom-navigation>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    components: {
        
    },
    props: {
        
    },
    data: function(){
        return{
           
        }
    },
    mounted(){
        
    },
    created(){

    },
    computed: {
        ...mapState([
            'user',
            'cart',
            'deliveryAddress',
        ]),
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        totalPrice(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
            let totalAmount = amount + this.deliveryAddress.postage

            return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        }
    },
    methods: {
        ...mapActions([
            
        ]),
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        formatPrice(value){
          let amount = value;

          return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
    },
}
</script>

<style>
.charge{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 500;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
}

</style>