<template>
    <v-row>
        <v-col cols="12" sm="12" md="3" v-for="category in categories" :key="category.id">
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
                <!-- <div class="product-size mb-2">
                    {{product.size}}
                </div> -->
                <!-- <div class="product-price mb-4">
                    {{formatPrice(product.price)}}
                </div> -->
                <div class="product-details">
                    {{category.details}}
                </div>
            </v-card-text>

            <!-- <v-list-item three-line>
                <v-list-item-content>
                <div class="product-name mb-1">
                    {{product.name}}
                </div>
                <div class="product-size mb-4">
                    {{product.size}}
                </div>
                <div class="product-price mb-6">
                    {{formatPrice(product.price)}}
                </div>
                <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-avatar
                tile
                size="80"
                color="grey"
                ></v-list-item-avatar>
            </v-list-item>
            -->
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
        ])
    
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