<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Category Details
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            カテゴリー詳細
                        </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                    <div class="mb-4">
                        <div class="item-content">
                        カテゴリーID
                        </div>
                        <div class="item-title">
                        {{category.id}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        カテゴリー名
                        </div>
                        <div class="item-title">
                        {{category.name}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        ステータス
                        </div>
                        <div class="item-title">
                            <v-chip
                             :color="getColor(category.status)" dark
                             class="mb-2"
                            >
                            {{category.status}}
                            </v-chip>
                        </div>
                        <v-row>
                            <v-col cols="12" sm="12" md="8">
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateStatus"
                                        class="mb-2"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showUpdateCategoryStatus == true">
                                    <updatecategorystatus-component
                                        v-bind:category="category"
                                    ></updatecategorystatus-component>
                                </div>
                            </v-col>
                        </v-row>
                    </div>
                    <div class="mb-8">
                        <v-btn
                            color="primary"
                            outlined
                            @click="$router.push({name: 'categories-list'})"
                        >
                            リストへもどる
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="12" sm="12" md="8">
                    <v-row>
                        <v-col cols="12" sm="12" md="8">
                            <div class="mb-10">
                                <v-img
                                    max-width=240
                                    :src="category.absolute_path"
                                >
                                </v-img>
                            </div>
                            <div class="mb-10">
                                <h4 class="jp-font grey--text text--darken-3 mb-4">カテゴリーサブタイトル</h4>
                                <div class="jp-font-400 mb-2" v-if="category.subtitle === null">
                                    未設定
                                </div>
                                <div class="mb-2" v-if="category.sugtitle !== null">
                                    {{category.subtitle}}
                                </div>
                                <div class="mb-2">
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateSubtitle"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showEditSubtitle == true">
                                    <editsubtitle-component
                                        v-bind:category="category"
                                    ></editsubtitle-component>
                                </div>
                            </div>
                            <div class="mb-10">
                                <h4 class="jp-font grey--text text--darken-3 mb-4">詳細</h4>
                                <div class="jp-font-400 mb-2" v-if="category.details === null || category.details === ''">
                                    未設定
                                </div>
                                <div class="mb-2" v-if="category.details !== null | category.details !== ''">
                                    {{category.details}}
                                </div>
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateDetails"
                                        class="mb-2"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showEditDetails == true">
                                    <editdetails-component
                                        v-bind:category="category"
                                    ></editdetails-component>
                                </div>
                            </div>
                            <div class="mb-10">
                                <h4 class="jp-font grey--text text--darken-3 mb-4">説明文</h4>
                                <div class="jp-font-400 mb-2" v-if="category.description === null || category.description === ''">
                                    未設定
                                </div>
                                <div class="mb-2" v-if="category.description !== null || category.description !== ''">
                                    {{category.description}}
                                </div>
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateDescription"
                                        class="mb-2"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showEditDescription == true">
                                    <editdescription-component
                                        v-bind:category="category"
                                    ></editdescription-component>
                                </div>
                            </div>
                            <div class="mb-10">
                                <h4 class="jp-font grey--text text--darken-3 mb-4">シーズン</h4>
                                <div class="jp-font-400 mb-2" v-if="category.season === null || category.season === ''">
                                    未設定
                                </div>
                                <div class="mb-2" v-if="category.season !== null || category.season !== ''">
                                    {{category.season}}
                                </div>
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateSeason"
                                        class="mb-2"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showEditSeason == true">
                                    <editseason-component
                                        v-bind:category="category"
                                    ></editseason-component>
                                </div>
                            </div>
                            <div class="mb-10">
                                <h4 class="jp-font grey--text text--darken-3 mb-4">原材料</h4>
                                <div class="jp-font-400 mb-2" v-if="category.ingredients === null || category.ingredients === ''">
                                    未設定
                                </div>
                                <div class="mb-2" v-if="category.ingredients !== null || category.ingredients !== ''">
                                    {{category.ingredients}}
                                </div>
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="updateIngredients"
                                        class="mb-2"
                                    >更新</v-btn>
                                </div>
                                <div v-if="showEditIngredients == true">
                                    <editingredients-component
                                        v-bind:category="category"
                                    ></editingredients-component>
                                </div>
                            </div>
                            <div class="mb-8">
                                <div class="mb-8">
                                <h4 class="jp-font grey--text text--darken-3 mb-4">画像</h4>
                                <div>
                                    <editimage-component
                                        v-bind:category="category"
                                    ></editimage-component>
                                </div>
                                </div>
                            </div>

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
        this.$store.dispatch('admin/fetchCategory', {
            id: this.id
        });
        
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'category',
            'showEditSubtitle',
            'showEditDetails',
            'showEditDescription',
            'showEditSeason',
            'showEditIngredients',
            'showUpdateCategoryStatus',
            // 'dialogShipment',
            // 'dialogUpdateShipment',
            // 'dialogUpdateStatus',
            // 'plannedShipmentDate',
            // 'actualShipmentDate',
            // 'deliveredDate',
            // 'orderStatus',
        ]),
        // cartTotal(){
        //     let amount = this.orderedProducts.reduce((acc,item) => acc + (item.price * item.quantity), 0);

        //     return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        // },
        // totalPrice(){
        //      let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
        //      let totalAmount = cartAmount + this.deliveryAddress.postage

        //      return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        // },
    
    },
    methods: {
        getColor(status){
            if (status == 'Ongoing') return '#67A8DD'
            else if (status == 'Draft') return 'info'
            else return '#85D1BB'
        },
        updateSubtitle(){

            if(this.showEditSubtitle == false){
                this.$store.commit('admin/setShowEditSubtitle', true);
            }else{
                this.$store.commit('admin/setShowEditSubtitle', false);
            }
            
        },
        updateDetails(){

            if(this.showEditDetails == false){
                this.$store.commit('admin/setShowEditDetails', true);
            }else{
                this.$store.commit('admin/setShowEditDetails', false);
            }
        },
        updateDescription(){

            if(this.showEditDescription == false){
                this.$store.commit('admin/setShowEditDescription', true);
            }else{
                this.$store.commit('admin/setShowEditDescription', false);
            }

        },
        updateSeason(){

            if(this.showEditSeason == false){
                this.$store.commit('admin/setShowEditSeason', true);
            }else{
                this.$store.commit('admin/setShowEditSeason', false);
            }

        },
        updateIngredients(){
            
             if(this.showEditIngredients== false){
                this.$store.commit('admin/setShowEditIngredients', true);
            }else{
                this.$store.commit('admin/setShowEditIngredients', false);
            }
        },
        updateImage(){

        },
        updateStatus(){

            if(this.showUpdateCategoryStatus == false){
                this.$store.commit('admin/setShowUpdateCategoryStatus', true)
            }else{
                this.$store.commit('admin/setShowUpdateCategoryStatus', false)
            }
        }

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
        
    }


}
</script>

<style>

</style>