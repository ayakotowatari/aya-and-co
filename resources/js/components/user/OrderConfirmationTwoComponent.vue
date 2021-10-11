<template>
    <div class="pt-6">
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <div class="form-title grey--text text--darken-4">注文内容を確認する</div>
            </v-col>
        </v-row>
        <v-row justify="center" class="mb-4">
           <v-col cols="12" sm="12" md="8">
                <v-row>
                    <v-col cols="12" sm="12" md="6" v-for="item in cart" :key="item.id">
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
                                    :src="`https://s3-ap-northeast-1.amazonaws.com/aya-and-co/${item.image}`"
                                ></v-img>
                            </v-list-item-avatar>
                            </v-list-item>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="8" sm="8" md="3" class="py-1">
                        <div class="totalprice grey--text text--darken-3">
                            商品小計（税込）
                        </div>
                    </v-col>
                    <v-col cols="4" sm="4" md="3" class="py-1">
                        <div v-text="cartTotal" class="totalprice">
                        </div>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="8" sm="8" md="3" class="py-1">
                        <div class="totalprice grey--text text--darken-3">
                            送料
                        </div>
                    </v-col>
                    <v-col cols="4" sm="4" md="3" class="py-1">
                        <div class="totalprice">
                            {{formatPrice(deliveryAddress.postage)}}
                        </div>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="8" sm="8" md="3" class="py-1">
                        <div class="charge grey--text text--darken-3">
                            ご請求額
                        </div>
                    </v-col>
                    <v-col cols="4" sm="4" md="3" class="py-1">
                        <div v-text="totalPrice" class="charge">
                        </div>
                    </v-col>
                </v-row>
                <v-row class="mb-4">
                    <v-col cols="12" sm="12" md="12">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <h4 class="jp-font grey--text text--darken-3 mb24">お届け先のご住所等</h4>
                <v-row>
                    <v-col cols="12" sm="12" md="8">
                        <v-card
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
                                        配送方法
                                    </v-list-item-subtitle>
                                    <v-list-item-title class="jp-font-400">
                                        {{deliveryAddress.courier_type}}
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
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle class="jp-font-400">
                                        カードメッセージのご利用
                                    </v-list-item-subtitle>
                                    <!-- <div>
                                        <v-list-item-title class="jp-font-400">
                                            メッセージ：{{deliveryCardMessage}}
                                        </v-list-item-title>
                                        <v-list-item-title class="jp-font-400">
                                            差出人名の表記：{{deliveryCardName}}
                                        </v-list-item-title>
                                    </div> -->
                                    <div v-if="deliveryCardUse === '利用しない'">
                                        利用なし
                                    </div>
                                    <div v-if="deliveryCardUse === '利用する'">
                                        <v-list-item-title class="jp-font-400">
                                            メッセージ：{{deliveryCardMessage}}
                                        </v-list-item-title>
                                        <v-list-item-title class="jp-font-400">
                                            差出人名の表記：{{deliveryCardName}}
                                        </v-list-item-title>
                                    </div>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-col>
                </v-row>

           </v-col>
        </v-row>
       
        <!-- <v-row>
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
        </v-row> -->
        <!-- <v-bottom-navigation class="hidden-md-and-up" background-color="primary" grow dark fixed app>
            <v-btn
                class="jp-font-400"
                @click="$router.push({name: 'checkout'})"
            >
                レジへ進む
            </v-btn>
        </v-bottom-navigation> -->
    </div>
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
        // this.$store.commit('selectAddress');

    },
    computed: {
        ...mapState([
            'user',
            'cart',
            'deliveryAddress',
            'deliveryCardUse',
            'deliveryCardMessage',
            'deliveryCardName'
        ]),
        // deliveryCardUse(){
        //     return this.$store.getters.deliveryCardUse
        // },
        // deliveryCardMessage(){
        //     return this.$store.getters.deliveryCardMessage
        // },
        // deliveryCardName(){
        //     return this.$store.getters.deliveryCardName
        // },
        cartTotal(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

                console.log(cartAmount);
                return cartAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        totalPrice(){

           
                let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                let totalAmount = cartAmount + this.deliveryAddress.postage

                console.log('totalAmount', totalAmount)

                return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
       
            
        },
       
    },
    methods: {
        ...mapActions([
            
        ]),
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
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