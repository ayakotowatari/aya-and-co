<template>
    <div class="mb-8">
        <p class="description">
            ゆうパックでは、宅配50サイズ（長さ201mm × 幅167mm × 深さ102mm）の箱のなかに、木毛の緩衝材を用いて商品を配置します。
        </p>
        <p class="description mb-8">
            会員登録をされたお客様で、ゆうパックをご利用になる場合は、「<router-link to="/message-service">選べるメッセージカード</router-link>」のサービス（無料）をご利用いただけます。ご注文時にお好きなメッセージを選んでいただきましたら、ご希望によってお客様のお名前とともに、葉書サイズのaya & co.特製のカードを丁寧に印刷して、同封いたします。
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            おすすめの用途
        </div>
        <p class="description mb-8">
            ご自身へのご褒美や、ご家族・ご友人へのギフトとして贈られるときなど、大切なオケージョンには、ゆうパックのご利用がおすすめです。
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            1梱包でお送りできる商品数
        </div>
        <p class="description">
            セット商品：　1セットまで<br>
            単品：　100g瓶・140g瓶、あわせて3つまで
        </p>
        <p class="description mb-8">
            1セット、もしくは単品3つ以上の商品をご注文いただくことも可能です。配送方法等についてご相談させていただきますので、ご注文の前にぜひお問い合わせください。
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            そのほか
        </div>
        <p class="description">
            会員登録されているお客様で、ご自宅でお受け取りになったうえで、どなたかにギフトとして手渡しされたい場合には、ご注文時に備考欄へその旨をご記入ください。梱包後に、さらに別の箱に梱包して、お送りします。
        </p>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            tab: null,
        items: [
          'web', 'shopping', 'videos', 'images', 'news',
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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

</style>