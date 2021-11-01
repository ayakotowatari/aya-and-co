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
                <v-row align="start">
                    <v-col cols="12" sm="12" md="6" class="mb-4">
                        <v-row>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    商品小計（税込）
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div v-text="cartTotal" class="totalprice">
                                </div>
                            </v-col>
                        </v-row>
                        <v-row v-if="coupon.applied !== false && coupon.type !== 'postage'">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    クーポン割引
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    -{{formatPrice(discount)}}
                                </div>
                            </v-col>
                            <!-- <v-col cols="6" sm="6" md="6" class="py-1" v-if="coupon.type == 'fixed'">
                                <div class="totalprice">
                                    -{{formatPrice(coupon.value)}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1" v-if="coupon.type == 'percent'">
                                <div v-text="percentDiscount" class="totalprice">
                                    
                                </div>
                            </v-col> -->
                        </v-row>
                        <v-row>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    送料
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    {{formatPrice(deliveryAddress.postage)}}
                                </div>
                            </v-col>
                        </v-row>
                        <v-row v-if="coupon.applied !== false && coupon.type == 'postage'">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    クーポン割引
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    -{{formatPrice(discount)}}
                                </div>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-divider></v-divider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="charge grey--text text--darken-3">
                                    ご請求額
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div v-text="totalPrice" class="charge">
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" sm="12" md="4">
                         <v-row class="mb-4">
                            <v-col cols="12" sm="12" md="12">
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-text-field
                                        v-model="coupon_code"
                                        label="クーポンコード" 
                                        outlined
                                        :error="allError.coupon || allError.coupon_code ? true : false"
                                        :error-messages="allError.coupon || allError.coupon_code"
                                    ></v-text-field>
                                    <v-btn
                                        @click="apply()"
                                        v-if="couponDisabled == false"
                                    >
                                        クーポンを適用する
                                    </v-btn>
                                    <v-btn
                                        @click="resetCoupon()"
                                        v-if="couponDisabled == true"
                                    >
                                        削除・リセットする
                                    </v-btn>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
                
                <v-row class="mb-4">
                    <v-col cols="12" sm="12" md="12">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <!-- <v-select
                    v-model="use_coupon"
                    label="クーポンの使用"
                    outlined
                    :items = "ask_coupon"
                    required
                >
                </v-select> -->
                <h4 class="jp-font grey--text text--darken-3 mb24">お届け先のご住所・配送オプション等</h4>
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
                                    <div v-if="deliveryAddress.courier_type === 'ヤマト運輸 宅急便コンパクト'">
                                        <v-list-item-title class="jp-font-400">
                                            梱包数：{{deliveryAddress.box_quantity}}
                                        </v-list-item-title>
                                    </div>
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
                            <div>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            備考欄
                                        </v-list-item-subtitle>
                                        <div v-if="deliveryAddress.delivery_note !==''">
                                            <p class="jp-font-400 line-height">
                                                {{deliveryAddress.delivery_note}}
                                            </p>
                                        </div>
                                        <div v-if="deliveryAddress.delivery_note ==''">
                                            <v-list-item-title class="jp-font-400">
                                                なし
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                            </div>
                            <!-- <div v-if="deliveryAddress.courier_type == '日本郵便 ゆうパック'">
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            備考欄
                                        </v-list-item-subtitle>
                                        <div v-if="deliveryAddress.delivery_note !==''">
                                            <v-list-item-title class="jp-font-400">
                                                {{deliveryAddress.delivery_note}}
                                            </v-list-item-title>
                                        </div>
                                        <div v-if="deliveryAddress.delivery_note ==''">
                                            <v-list-item-title class="jp-font-400">
                                                なし
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                            </div> -->
                        </v-card>
                    </v-col>
                </v-row>

           </v-col>
        </v-row>
    </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    components: {
        
    },
    props: {
        deliveryAddress: Object
    },
    data: function(){
        return{
            valid: true,
            coupon_code: null,
            // couponRules: [
            //     v => !!v || 'クーポンコードを入力してください。',
            // ],
            use_coupon: '使用しない',
            ask_coupon: ['使用する', '使用しない']
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
            'deliveryCardUse',
            'deliveryCardMessage',
            'deliveryCardName',
        ]),
        ...mapState('coupon', [
            'coupon',
            'allError',
            'couponDisabled'
        ]),
        ...mapGetters('coupon', [
            'discount'
        ]),
        cartTotal(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

                //console.log(cartAmount);
                return cartAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        totalPrice(){

            if(this.coupon.applied !== true){
                let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                let totalAmount = cartAmount + this.deliveryAddress.postage

                //console.log('totalAmount', totalAmount)

                return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});

            }else{

                let discount = this.discount
                let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                let totalAmount = (cartAmount + this.deliveryAddress.postage) - discount;

                return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
                   
            }
        },
       
    },
    methods: {
        ...mapActions('coupon', [
            'applyCoupon',
        ]),
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        apply(){
            this.applyCoupon({
                coupon_code: this.coupon_code
            })
        },
        resetCoupon(){
            this.$refs.form.reset();
            this.$store.commit('coupon/setCouponDisabled', false);
            this.$store.dispatch('coupon/clearAllErrors');
            this.$store.dispatch('coupon/clearCoupon');
        }
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

.line-height{
    line-height: 1.5;
}
</style>