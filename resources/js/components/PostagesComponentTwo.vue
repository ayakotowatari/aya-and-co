<template>
    <v-container>
         <div class="key-visual">
            <v-img
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/gift_box_2.jpg"
            ></v-img>
        </div>
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
                        ・宅急便（ヤマト運輸）<br>
                        ・宅急便コンパクト（ヤマト運輸）
                    </p>
                    <p class="description">
                        配送方法によって、パッケージ（包装）と送料が異なりますので、ご用途にあった方法をお選びください。<br>
                    </p>
                </div>
                <v-tabs v-model="tab" class="mb-12">
                    <v-tab
                        href="#tab-1"
                    >
                        宅急便
                    </v-tab>
                    <v-tab
                        href="#tab-2"
                    >
                        宅急便コンパクト
                    </v-tab>
                    <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
                </v-tabs>

                <v-tabs-items v-model="tab">
                    <v-tab-item 
                        value="tab-1"
                    >
                        <yamatotakkyubin-component></yamatotakkyubin-component>
                    </v-tab-item>
                    <v-tab-item
                        value="tab-2"
                    >
                        <yamatocompact-component></yamatocompact-component>
                    </v-tab-item>
                </v-tabs-items>

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
                <p class="description mb-8">
                    日本全国各地への、配送オプションごとの送料（1梱包の料金）は、下記よりお確かめいただけます。
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
                                v-for="postageYamatoTakkyubin in postageYamatoTakkyubins"
                                :key="postageYamatoTakkyubin.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="item-content">{{ postageYamatoTakkyubin.prefecture}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageYamatoTakkyubin.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                         <div v-if="this.courier === 2">
                            <div
                                v-for="postageYamatoBig in postageYamatoBigs"
                                :key="postageYamatoBig.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="item-content">{{ postageYamatoBig.prefecture}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageYamatoBig.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                        <div v-if="this.courier === 3">
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
            'postageYamatoTakkyubins',
            'postageYamatoBigs',
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

.spot-color{
    color: #FE6862
}

@media(max-width:780px){
   .delivery-image{
       max-width: 100px;
   }
}
</style>