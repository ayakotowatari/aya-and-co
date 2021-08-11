<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Policy
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        特定商取引法に基づく表記
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div class="mb-6">
                    <div class="item-content policy-title">
                        事業者
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        aya & co.（アヤアンドコー）
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        責任者
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        上田文子
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        住所
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        神奈川県川崎市宮前区有馬1-6-1-505
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        商品の価格
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        各商品ページにて表示しております。
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        商品代金以外の付帯費用
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        送料<br>
                        日本郵便の運賃によります。詳しくは、<router-link to="/postage">送料のページ</router-link>をご覧ください。
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        運送業者
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        日本郵便
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        商品発送時期
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        通常は、ご注文より1週間以内に発送いたします。これよりも遅れる場合は、別途、お客様までメールでご連絡いたします。
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        時間指定の有無
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        配達時間のご希望を、ご注文のお手続きのなかでご指定いただけます。
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        お支払い方法
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        Stripeの決済プラットフォームを使用した、クレジットカードでのお支払いとなります。
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        返品
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-2">
                        ①返品・交換時期
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-6">
                        <p>
                            商品の品質につきましては徹底した管理のもとお届けしております。お届けした商品は、到着後すぐにご開封ください。
                        </p>
                        <p>
                            万一配送中の事故で破損や汚損などがあった場合は、商品到着後、7日以内に下記メールアドレスまでご連絡ください。商品の返品後は、必ずお手元に送り状の控えを保管しておいてください。
                        </p>
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-2">
                        ②お客様都合の場合
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-6">
                        <p>
                            返品・交換はできません。また、ご賞味後の返品はご遠慮願います。
                        </p>
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-2">
                        ③商品不備等の場合
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-6">
                        <p>
                            弊社手違いによる商品のお届け間違い、商品の不備、配送途中の事故などによる欠損等があった場合は、返品送料・再発送料等、手数料は弊社負担でお取り替えいたします。なお、同じ商品の再発送が困難な場合は、お客様にご連絡の上、代金を返金させていただきます。
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        お問い合わせ
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        <router-link to="/contact">お問い合わせフォーム</router-link>をご利用ください。
                    </div>
                </div>
                
                <!-- <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    このページは、ただいま準備中です。
                </div> -->
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: function(){
        return {
            
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
    
    },
    methods: {
      

        
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

</style>