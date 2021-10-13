<template>
    <div class="mb-8">
        <p class="description">
            宅急便コンパクトでは、ヤマト運輸の薄型の専用ボックスに、木毛の緩衝材を用いて商品を配置します。ボックスの高さがあまりないため、たとえば140g以上のサイズの瓶は、横向きに倒した状態で包装いたします。
        </p>
        <p class="description mb-8">
            また、葉書サイズのカードは瓶に押されて折り目がついてしまうため、同封できず、「<router-link to="/message-service">選べるメッセージカード</router-link>」はご利用いただけません。
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
            宅急便コンパクトは、ゆうパックと比較して、審美的には劣りますが、送料はリーズナブルで、ご自宅での普段づかいとしてお買い求めいただく際におすすめいたします。
        </p>

         <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <div class="item-content policy-title mb-4">
            1梱包（宅急便コンパクト）でお送りできる商品数
        </div>
        <p class="description">
            セット商品、単品（100g、140g）あわせて、全部で4瓶までとなります。
        </p>
        <p class="description">
            5瓶以上の商品をご注文いただくことも可能です。その際には、複数の梱包となり、梱包数分の送料がかかります。
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