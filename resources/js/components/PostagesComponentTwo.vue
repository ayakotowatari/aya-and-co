<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Packaging & Postage
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        配送方法と送料について
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <div class="item-title">配送方法について</div>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div class="mb-8">
                    <p class="description">
                        aya & co.では、商品のご注文時に、以下の２つのオプションから配送方法をお選びいただけます。
                    </p>
                    <p class="description">
                        ・ゆうパック（日本郵便）<br>
                        ・宅急便コンパクト（ゆうパック）
                    </p>
                    <p class="description">
                        配送方法によって、パッケージ（包装）と送料が異なります。<br>
                    </p>
                </div>
                <v-row class="mb-8">
                    <v-col cols="12" sm="12" md="12" class="line-color">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        ゆうパック
                    </div>
                    <p class="description">
                        ゆうパックでは、宅配50サイズ（長さ201mm × 幅167mm × 深さ102mm）の箱のなかに、木毛の緩衝材を用いて商品を配置します。さらに、葉書サイズの「<router-link to="/message-service">選べるメッセージカード</router-link>」を同封します。
                    </p>
                    <p class="description">
                        ゆうパックは、ご自宅用だけでなく、とくに、ギフトとしてお送りいただく際に適しております。
                    </p>
                </div>
                <v-row class="mb-8">
                    <v-col cols="12" sm="12" md="12" class="line-color">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        宅急便コンパクト
                    </div>
                    <p class="description">
                        宅急便コンパクトでは、ヤマト運輸による専用ボックスに、木毛の緩衝材を用いて商品を配置します。ボックスの高さが限られているため、140g以上のサイズの瓶は、横向きに倒した状態で包装いたします。
                    </p>
                    <p class="description">
                        また、葉書サイズのメッセージカードは瓶に押されて折り目がついてしまうため、「<router-link to="/message-service">選べるメッセージカード</router-link>」はご利用いただけません。
                    </p>
                    <p class="description">
                        宅急便コンパクトは、ゆうパックと比較して、審美的にはやや劣りますが、送料はリーズナブルで、ご自宅用にお買い求めいただく際に適した方法となります。
                    </p>
                </div>
                <div class="divider-image delivery-image">
                    <v-img
                        max-width=120
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/delivery.png"
                    ></v-img>
                </div>
                </v-col>
                </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <div class="item-title">送料について</div>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <p class="description mb-6">
                    配送オプションごとの、日本全国各地への送料は、下記よりお確かめいただけます。
                </p>
                <v-row>
                    <v-col cols="12" sm="12" md="6">
                        <v-select
                            v-model="courier"
                            :items="couriers"
                            item-text="courier_type"
                            item-value="id"
                            label="配送方法を選ぶ"
                            required
                            class="mb24"
                            solo
                        ></v-select>
                        <div v-if="this.courier === 1">
                            <div
                                v-for="postageYupack in postageYupacks"
                                :key="postageYupack.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="item-content">{{ postageYupack.prefecture}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageYupack.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                        <div v-if="this.courier === 2">
                            <div
                                v-for="postageCompact in postageCompacts"
                                :key="postageCompact.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="item-content">{{ postageCompact.prefecture}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageCompact.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                    </v-col>
                </v-row>
                <!-- <table v-for="postage in postages" :key="postage.id">
                    <tr>
                        <td>{{ postage.prefecture }}</td>
                        <td>{{ postage.postage }}</td>
                    </tr>
                </table> -->
                <!-- <v-tabs
                    v-model="tab"
                >
                    <v-tab
                        href="#tab-1"
                    >
                        ゆうパック（日本郵便）
                    </v-tab>
                    <v-tab
                        href="#tab-2"
                    >
                        宅急便コンパクト（ヤマト運輸）
                    </v-tab>
                </v-tabs>

                <v-tabs-items
                    v-model="tab"
                >
                    <v-tab-item
                       value="tab-1"
                       v-for="postageYupack in postageYupacks"
                       :key='postageYupack.id'
                    >
                        <v-row>
                            <v-col cols="6" sm="6" md="2">
                                <div class="item-content">{{ postageYupack.prefecture}}</div>
                            </v-col>
                            <v-col cols="6" sm="6" md="2">
                                <div class="grey--text text--darken-3">{{ formatPrice(postageYupack.postage)}}</div>
                            </v-col>
                        </v-row>
                    </v-tab-item>
                    <v-tab-item
                       value="tab-2"
                       v-for="postageCompact in postageCompacts"
                       :key='postageCompact.id'
                    >
                        <v-row>
                            <v-col cols="6" sm="6" md="2">
                                <div class="item-content">{{ postageCompact.prefecture}}</div>
                            </v-col>
                            <v-col cols="6" sm="6" md="2">
                                <div class="grey--text text--darken-3">{{ formatPrice(postageCompact.postage)}}</div>
                            </v-col>
                        </v-row>
                    </v-tab-item>

                </v-tabs-items> -->

                <!-- <div v-for="postage in postages" :key="postage.id">
                    <v-row>
                        <v-col cols="6" sm="6" md="2">
                            <div class="item-content">{{ postage.prefecture}}</div>
                        </v-col>
                        <v-col cols="6" sm="6" md="2">
                            <div class="grey--text text--darken-3">{{ formatPrice(postage.postage)}}</div>
                        </v-col>
                    </v-row>
                </div> -->
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            courier: null,
            tab: null,
            postageType: null,
        }
    },
    mounted(){
      
    },
    created(){
        this.$store.dispatch('fetchPostages')
    },
    computed: {
        ...mapState([
            'postages',
            'postageYupacks',
            'postageCompacts',
            'couriers'
        ])
    },
    methods: {
        formatPrice(value){
          return value.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'})
        },
    }


}
</script>

<style>
.policy-title{
    font-size: 14px;
}

.item-title a{
    text-decoration: none;
}

.mb16{
    margin-bottom: 16px;
}

@media(max-width:780px){
   .delivery-image{
       max-width: 100px;
   }
}
</style>