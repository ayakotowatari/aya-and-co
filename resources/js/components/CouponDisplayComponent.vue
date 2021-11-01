<template>
    <div v-if="user !== null && ifCoupon !== false">
         <v-card>
            <v-card-title class="jp-font-400-20">
                 <v-icon
                    color="primary"
                    class="mr-2"
                >
                    mdi-ticket
                </v-icon>  
                クーポンをご利用いただけます。
            </v-card-title>
            <v-card-text class="jp-font-400">
                {{user.name}}様、いつもaya & co.をご利用いただき、誠にありがとうございます。
            </v-card-text>
            <v-card-text class="jp-font-400">
                感謝の気持ちを込めまして、本サイトでの2回目以降のお買い物で、1,000円以上のお買い上げでお使いいただけるクーポンを発行いたしました。
            </v-card-text>
            <v-card-text class="jp-font-400">
                ご注文時に、下記のクーポン番号をご入力いただくと、商品のお買い上げ金額の10％引きとなります。ぜひご利用ください。
            </v-card-text>
            <v-card-text class="jp-font-400">
                このクーポンの有効期限は、<strong>{{couponDeadline}}</strong>です。
            </v-card-text>
             <v-card-text class="jp-font-400">
                クーポン番号: <strong>thanks10</strong>
            </v-card-text>
             <v-card-text class="jp-font-400 small-description">
                クーポンは1回限りでご利用いただけます。
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

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
        ...mapState([
            'user'
        ]),
        ...mapState('coupon',[
            'ifCoupon',
            'couponDeadline'
        ]),
    },
    methods: {

        
    }


}
</script>

<style>
.small-description{
    font-size: 12px;
}

.dialog-title-14{
    font-size: 16px;
    font-weight: 400;
}

.jp-font-400-20{
    line-height: 1.5;
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
    letter-spacing: 0.03em;
    /* color: rgba(0, 0, 0, 0.6) */
}

</style>