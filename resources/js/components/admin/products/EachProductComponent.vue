<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Product Details
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            商品詳細
                        </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                    <div class="mb-4">
                        <div class="item-content">
                        商品ID
                        </div>
                        <div class="item-title">
                        {{product.id}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        商品スラッグ
                        </div>
                        <div class="item-title">
                        {{product.slug}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        在庫数
                        </div>
                        <div class="item-title mb-2">
                        {{product.inventory}}
                        </div>
                        <div>
                            <v-btn
                                color="primary"
                                outlined
                                @click="updateInventory"
                                class="mb-2"
                            >更新</v-btn>
                        </div>
                        <div v-if="showUpdateInventory == true">
                            <updateinventory-component
                                v-bind:product="product"
                            ></updateinventory-component>
                        </div>
                    </div>
                     <div class="mb-8">
                        <div class="item-content">
                        販売個数
                        </div>
                        <div class="item-title mb-2">
                        {{product.total}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        ステータス
                        </div>
                        <div class="item-title">
                            <v-chip
                             :color="getColor(product.status)" dark
                             class="mb-2"
                            >
                            {{product.status}}
                            </v-chip>
                        </div>
                        <v-row>
                            <v-col cols="12" sm="12" md="8">
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateProductStatus"
                                        class="mb-2"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showUpdateProductStatus == true">
                                    <updateproductstatus-component
                                        v-bind:product="product"
                                    ></updateproductstatus-component>
                                </div>
                            </v-col>
                        </v-row>
                    </div>
                    <div class="mb-8">
                        <v-btn
                            color="primary"
                            outlined
                            @click="$router.push({name: 'products-list'})"
                        >
                            リストへもどる
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="12" sm="12" md="8">
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-card
                                max-width="390"
                                outlined
                                color="#F1F1F1"
                            >
                                <v-list-item three-line>
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
                                </v-list-item-content>
                                <v-list-item-avatar
                                    tile
                                    size="80"
                                    color="grey"
                                >
                                    <v-img
                                        src="../../assets/img/IMG_9502.JPG"
                                    ></v-img>
                                </v-list-item-avatar>
                                </v-list-item>
                            </v-card>
                          </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-container> 
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            id: Number(this.$route.params.id),
            
        }
    },
    mounted(){
        this.$store.dispatch('admin/fetchProduct', {
            id: this.id
        });
        
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'product',
            'showUpdateInventory',
            'showUpdateTotal',
            'showUpdateProductStatus'
        ]),
    },
    methods: {
        updateInventory(){
            
            this.$store.commit('admin/setShowUpdateInventory', true);
            
        },
        updateTotal(){

            this.$store.commit('setShowUpdateTotal', true);

        },
        getColor(status){
            if (status == 'Ongoing') return '#67A8DD'
            else if (status == 'Draft') return 'info'
            else return '#85D1BB'
        },
        updateProductStatus(){
            this.$store.commit('admin/setShowUpdateProductStatus', true)
        },
        // updateStatus(){
        //     this.$store.commit('admin/dialogUpdateStatus', true)
        // },
        // scheduleDate(){
        //     this.$store.commit('admin/dialogShipment', true)
        // },
        // updateDate(){
        //     this.$store.commit('admin/dialogUpdateShipment', true)
        // },
        // formatPrice(value){
        //   let price = value;

        //   return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        // },
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        
    }


}
</script>

<style>

</style>