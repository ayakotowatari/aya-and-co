<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Unsubscribe Emails
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            メール配信の停止
                        </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                    
                </v-col>
                <v-col cols="12" sm="12" md="8">
                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                メールの配信停止を希望されますか？
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    @click="$store.commit('setDialogUnsubscribe', true)"
                                >
                                    削除する
                                </v-btn>
                            </div>
                            <div class="jp-font-400 grey--text text--darken-2 mb-3">
                                メールの配信停止をされたあとでも、ウェブサイトの運営上、必要なご連絡はお送りすることがあります。あらかじめご了承ください。
                            </div>

                        </div>
                </v-col>
            </v-row>
        </v-container>
        <unsubscribedialog-component
            v-bind:user="user"
            v-bind:dialogUnsubscribe="dialogUnsubscribe"
        ></unsubscribedialog-component>
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
        this.$store.dispatch('coupon/fetchCoupons');
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'user',
            'dialogUnsubscribe',
        ]),
    },
    methods: {
        ...mapActions([
            
        ])
      
    }


}
</script>

<style>
.mb60 {
  margin-bottom: 60px;

}

@media(max-width:780px){
    .pine-image{
      max-width: 90px;
    }
}

</style>