<template>
    <div v-if="user !== null && ifCoupon !== false">
         <v-card>
            <v-card-title class="ja-font-400 dialog-title-14">
                 <v-icon
                    color="primary"
                    class="mr-2"
                >
                    mdi-ticket
                </v-icon>  
                クーポンをご利用いただけます。
            </v-card-title>
            <v-card-text class="ja-font-400">
                {{user.name}}様へ、本サイトで2回目のお買い物にお使いいただけるクーポンが発行されています。
            </v-card-text>
             <v-card-text class="ja-font-400">
                 ご注文時に、下記のクーポン番号をご入力いただくと、商品のお買い上げ金額の10％引きとなります。ぜひご利用ください。
            </v-card-text>
             <v-card-text class="ja-font-400">
                クーポン番号: thanks10
            </v-card-text>
             <v-card-text class="ja-font-400 small-description">
                  クーポンは1回限りのご利用となり、有効期限は、2021年11月30日です。
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
            'ifCoupon'
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

</style>