<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-select
                    v-model="status"
                    label = "ステータス"
                    :items="statuses"
                    item-text="status"
                    item-value="id"
                >
                </v-select>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponStatus"
                >
                    更新する
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="back"
                >
                    戻る
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
  
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        adminCoupon: Object,
    },
    data: function(){
        return {
            valid: true,
            status: '',
            statusRules: [
                v => !!v || 'ステータスを選択してください。',
            ],
        }
    },
    mounted(){

        this.$store.dispatch('coupon/fetchStatuses');
      
    },
    created(){
     
    },
    computed: {
        ...mapState('coupon', [
            'allerror',
            'statuses'
        ]),
    },
    methods: {
        ...mapActions('coupon', [
            'updateStatus'
        ]),
        updateCouponStatus(){

            if(this.$refs.form.validate()){
                this.updateStatus({
                    id: this.adminCoupon.id,
                    status_id: this.status
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingStatus', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>