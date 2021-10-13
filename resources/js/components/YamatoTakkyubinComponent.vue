<template>
    <div class="mb-8">
        <p class="description">
            宅急便では、小型サイズの配送用ボックスのなかに、木毛の緩衝材を用いて商品を配置します。
        </p>
        <p class="description mb-8">
            会員登録をされたお客様で、宅急便をご利用になる場合は、「<router-link to="/message-service">選べるメッセージカード</router-link>」のサービス（無料）をご利用いただけます。ご注文時にお好きなメッセージを選んでいただきましたら、ご希望によってお客様のお名前とともに、葉書サイズのaya & co.特製のカードを丁寧に印刷して、同封いたします。
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
            ご自身へのご褒美や、ご家族・ご友人へのギフトとして贈られるときなど、大切なオケージョンには、宅急便のご利用がおすすめです。
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            1梱包（宅急便）でお送りできる商品数
        </div>
        <p class="description">
            セット商品、単品（100g、140g）あわせて、全部で3瓶までとなります。
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            プラスサイズについて
        </div>
        <p class="description mb-8">
            4瓶以上の商品をご注文いただくことも可能です。その場合、一律で各地への通常送料のプラス290円（沖縄県のみ、プラス710円）でお送りさせていただきます。詳しくは「宅急便（プラスサイズ）」をご覧ください。
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            ご自宅で商品を受け取られてから、どなたかにギフトとして手渡しされる場合
        </div>
        <p class="description">
            セット商品1つ、あるいは、単品2つもしくは3つの組み合わせに限り、それらを梱包した後、ギフトボックスとしてご利用いただけるように、別の宅配ボックスに入れて配送いたします。ご注文時にご希望を備考欄へご記入ください。
        </p>
        <p class="description">
            このギフトボックスを何組かお求めの場合には、それぞれの「選べるメッセージカード」をお作りできますので、備考欄にご記入ください。
        </p>
        <p class="description">
            なおこのアレンジは、会員登録されているお客様限定とさせていただきます。
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