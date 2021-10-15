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
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    こちらのページは、現在、メンテナンス中です。公開まで、しばらくお待ちください。
                </div>
                <!-- <div class="divider-image delivery-image">
                    <v-img
                        max-width=120
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/delivery.png"
                    ></v-img>
                </div> -->
                <!-- <table v-for="postage in postages" :key="postage.id">
                    <tr>
                        <td>{{ postage.prefecture }}</td>
                        <td>{{ postage.postage }}</td>
                    </tr>
                </table> -->
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
            
        }
    },
    mounted(){
      
    },
    created(){
        this.$store.dispatch('fetchPostages')
    },
    computed: {
        ...mapState([
            'postages'
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

@media(max-width:780px){
   .delivery-image{
       max-width: 100px;
   }
}
</style>