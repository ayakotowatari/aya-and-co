<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Coupon Details
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            クーポン詳細
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
                                名前
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ adminCoupon.name }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.name"
                                    @click="$store.commit('coupon/setIsEditingName', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.name">
                                <editname-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></editname-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                タイプ
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                               {{ adminCoupon.type }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.type"
                                    @click="$store.commit('coupon/setIsEditingType', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.type">
                                <edittype-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></edittype-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                割引額
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ adminCoupon.value }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.value"
                                    @click="$store.commit('coupon/setIsEditingValue', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.value">
                                <editvalue-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></editvalue-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                割引率
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ adminCoupon.percent_off}}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.percentOff"
                                    @click="$store.commit('coupon/setIsEditingPercentOff', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.percentOff">
                                <editpercentoff-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></editpercentoff-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                最低累計金額
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ adminCoupon.minimum }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.minimum"
                                    @click="$store.commit('setIsEditingMinimum', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.minimum">
                                <editminimum-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></editminimum-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                有効期限
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ adminCoupon.deadline }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.deadline"
                                    @click="$store.commit('setIsEditingDeadline', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.deadline">
                                <editdeadline-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></editdeadline-component>
                            </div>
                        </div>

                         <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                ステータス
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ adminCoupon.status }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditing.status"
                                    @click="$store.commit('setIsEditingStatus', true)"
                                >
                                    編集
                                </v-btn>
                            </div>
                            <div v-if="isEditing.status">
                                <editstatus-component
                                    v-bind:adminCoupon='adminCoupon'
                                ></editstatus-component>
                            </div>
                        </div>
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
        this.$store.dispatch('coupon/fetchCoupon', {
            id: this.id
        });
    },
    created(){
     
    },
    computed: {
        ...mapState('coupon', [
            'adminCoupon',
            'isEditing',
        ]),
    
    },
    methods: {
        ...mapActions([
            'deleteUser'
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