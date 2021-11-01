<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Order Details
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            注文履歴詳細
                        </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                    <div class="mb-4">
                        <div class="item-content">
                        注文ID
                        </div>
                        <div class="item-title">
                        {{order.id}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        注文日
                        </div>
                        <div class="item-title">
                        {{order.created_at}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        発送予定日
                        </div>
                        <div class="item-title mb-2" v-if="plannedShipmentDate !== null">
                            {{plannedShipmentDate}} 
                        </div>
                        <div class="item-title mb-2" v-if="plannedShipmentDate === null">
                        まだ決定されていません。
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        発送日
                        </div>
                        <div class="item-title" v-if="actualShipmentDate !== null">
                            {{actualShipmentDate}}
                        </div>
                        <div class="item-title" v-if="actualShipmentDate === null">
                        まだ発送されていません。
                        </div>
                    </div>
                    <div v-if="order.status == 'Shipped' || order.status =='Delivered'" class="mb-8">
                        <v-btn
                            color="primary"
                            outlined
                            @click="create(order.id)"
                        >
                            納品書兼領収書ダウンロード
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="12" sm="12" md="8">
                    <v-row justify="start" class="mb-8">
                        <v-col cols="12" sm="12" md="12" v-for="product in orderedProducts" :key="product.id">
                            <v-card
                                max-width="390"
                                outlined
                                color="#F1F1F1"
                            >
                                <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="product-name mb-1">
                                        {{product.name}} 
                                    </div>
                                    <div class="product-size mb-4">
                                        {{product.size}}
                                    </div>
                                    <div class="product-price mb-6">
                                        {{formatPrice(product.price)}}　{{product.quantity}}点　
                                    </div>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    tile
                                    size="80"
                                    color="grey"
                                >
                                    <v-img
                                        :src="`https://s3-ap-northeast-1.amazonaws.com/aya-and-co/${product.image}`"
                                    ></v-img>
                                </v-list-item-avatar>
                                </v-list-item>
                            </v-card>
                          </v-col>
                        </v-row>
                            <v-row>
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="totalprice grey--text text--darken-3">
                                        商品小計（税込）
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1">
                                    <div class="totalprice">
                                        {{formatPrice(order.item_total)}}
                                    </div>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="totalprice grey--text text--darken-3">
                                        送料
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1">
                                    <div class="totalprice">
                                        {{formatPrice(order.postage)}}
                                    </div>
                                </v-col>
                            </v-row>
                            <v-row v-if="order.discount !== null">
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="totalprice grey--text text--darken-3">
                                        クーポン割引
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1">
                                    <div class="totalprice">
                                        - {{formatPrice(order.discount)}}
                                    </div>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="12" md="6">
                                    <v-divider></v-divider>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="charge grey--text text--darken-3">
                                        ご請求額
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1 mb48">
                                    <div class="charge">
                                        {{formatPrice(order.total)}}
                                    </div>
                                </v-col>
                            </v-row>
                      
                    
                    <v-divider class="mb48"></v-divider>

                    <h4 class="jp-font grey--text text--darken-3 mb-4">ご請求先</h4>
                    <v-row class="mb-6">
                        <v-col cols="12" sm="12" md="6">
                            <v-card
                                max-width="480"
                                outlined
                            >
                                <v-list-item>
                                    <v-list-item-content two-line>
                                        <v-list-item-subtitle class="jp-font-400">
                                            お名前
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400 mb-4">
                                            {{order.user_name}}様
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="jp-font-400">
                                            メールアドレス
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400 mb-4">
                                            {{order.user_email}}
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="jp-font-400">
                                            お電話
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400 mb-4">
                                            {{order.user_phone}}
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="jp-font-400">
                                            ご住所
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400">
                                            〒{{order.user_zipcode}}<br>
                                            {{order.user_prefecture}}{{order.user_city}} {{order.user_address_1}}<br>
                                        </v-list-item-title>
                                        <v-list-item-title v-if="order.user_building !== null" class="jp-font-400">
                                            {{order.user_building}}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-card>
                        </v-col>
                    </v-row>
                    <h4 class="jp-font grey--text text--darken-3 mb-4">お届け先</h4>
                    <v-row>
                        <v-col cols="12" sm="12" md="6" class="mb48">
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
                                            〒{{order.delivery_zipcode}}<br>
                                            {{order.delivery_prefecture}}{{order.delivery_city}}{{order.delivery_address_1}}<br>
                                        </v-list-item-title>
                                        <v-list-item-title v-if="order.user_building !== null" class="jp-font-400">
                                            {{order.delivery_building}}
                                        </v-list-item-title>
                                        <v-list-item-title class="jp-font-400">
                                            {{order.delivery_name}}様
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            お電話番号
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400">
                                            {{order.delivery_phone}}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            配送オプション
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400">
                                            {{order.delivery_courier}}
                                        </v-list-item-title>
                                        <div v-if="order.box_quantity !== null">
                                            <v-list-item-title class="jp-font-400">
                                                梱包数：{{order.box_quantity}}個
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                                  <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            ご希望のお届け時間帯
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="jp-font-400">
                                            {{order.delivery_time}}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            カードメッセージ
                                        </v-list-item-subtitle>
                                        <div v-if="order.delivery_carduse === '利用しない'">
                                            <v-list-item-title class="jp-font-400">
                                                利用なし
                                            </v-list-item-title>
                                        </div>
                                        <div v-if="order.delivery_carduse === '利用する'">
                                            <v-list-item-title class="jp-font-400">
                                                メッセージ：{{order.delivery_cardmessage}}
                                            </v-list-item-title>
                                            <v-list-item-title class="jp-font-400">
                                                差出人お名前の表記：{{order.delivery_cardname}}
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                                 <v-list-item>
                                    <div v-if="this.order.message !== null">
                                        <v-list-item-content>
                                            <v-list-item-subtitle class="jp-font-400">
                                                備考欄
                                            </v-list-item-subtitle>
                                            <p class="jp-font-400 line-height">
                                                {{order.message}}
                                            </p>
                                        </v-list-item-content>
                                    </div>
                                    <div v-if="this.order.message == null">
                                        <v-list-item-content>
                                            <v-list-item-subtitle class="jp-font-400">
                                                備考欄
                                            </v-list-item-subtitle>
                                            <v-list-item-title class="jp-font-400">
                                                なし
                                            </v-list-item-title>
                                        </v-list-item-content>
                                    </div>
                                </v-list-item>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-btn
                        color="primary"
                        outlined
                        @click="$router.push({name: 'order-summary'})"
                        class="hidden-sm-and-down"
                    >
                        注文履歴リストへ戻る
                    </v-btn>
                    <v-btn
                        color="primary"
                        outlined
                        block
                        @click="$router.push({name: 'order-summary'})"
                        class="hidden-md-and-up"
                    >
                        注文履歴リストへ戻る
                    </v-btn>
                </v-col>
            </v-row>
        </v-container> 
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            id: Number(this.$route.params.id),
            
        }
    },
    mounted(){
        this.$store.dispatch('fetchOrder', {
            id: this.id
        });
        this.$store.dispatch('fetchShipment', {
            id: this.id
        });
        
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'order',
            'orderedProducts',
            // 'shipment',
            'plannedShipmentDate',
            'actualShipmentDate',
            'deliveredDate',
        ]),
    },
    methods: {
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        create(id){

            window.location.href='/member/create-receipt/'+ id;
            
            // this.createUserReceipt({
            //     id: id
            // })

        }
    }


}
</script>

<style>

</style>