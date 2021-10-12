<template>
    <div>
        <div v-if="inSeasonCategories.length <= 0">
            <div class="jp-font-400 grey--text text--darken-2 mb48">
                現在、商品は完売、もしくは、シーズンまで準備中です。
            </div>
            <div class="message grey--text text--darken-3 mb-6">
                公式LINEアカウントで、商品の発売日をお知らせしています。ぜひご登録ください。
                </div>
                <div>
                <v-btn
                    href = "https://lin.ee/1RJJ9C3"
                    outlined
                    color="primary"
                >
                    LINEに友だち追加する
                </v-btn>
            </div>
        </div>
        <div v-if="inSeasonCategories.length > 0">
            <v-row>
                <v-col cols="12" sm="12" md="3" v-for="category in inSeasonCategories" :key="category.id">
                    <v-card
                        class="mx-auto"
                        max-width="344"
                        outlined
                        @click.prevent="showmore(category.id)"
                    >
                        <v-img
                            max-height="200"
                            :src="category.absolute_path"
                        > 
                        </v-img>
                        <v-card-text>
                            <div class="product-name mb-1">
                                {{category.name}}
                            </div>
                            <div class="product-season mb-4">
                                {{category.season}}
                            </div>
                            <div class="product-details">
                                {{category.details}}
                            </div>
                        </v-card-text>
                        <div class="link">
                            <router-link
                                :to="{
                                    name: 'products',
                                    params: {id: category.id}
                                }"
                                @click.native="scrollToTop"
                            >
                                <v-card-actions>
                                    <v-btn
                                    outlined
                                    rounded
                                    text
                                    @click.prevent="expand(category.id)"          >
                                    詳細
                                    </v-btn>
                                </v-card-actions>
                            </router-link>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </div>
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
            'categories'
        ]),
        inSeasonCategories(){

            return this.categories.filter(category => category.status_id === 1);
        },
    },
    methods: {
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        expand(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        
    }


}
</script>

<style>

</style>