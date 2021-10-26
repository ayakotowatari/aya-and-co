<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="percentOff"
                    label="割引率" 
                    outlined
                    required
                    :rules="percentRules"
                    :error="allerror ? true : false"
                    :error-messages="allerror"
                >
                </v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponPercentOff"
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
            percentOff: '',
            percentRules: [
                v => !!v || '割引率の入力が必要です。',
            ],
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState('coupon', [
            'allerror',
        ]),
    },
    methods: {
        ...mapActions('coupon', [
            'updatePercentOff'
        ]),
        updateCouponPercentOff(){

            if(this.$refs.form.validate()){
                this.updatePercentOff({
                    id: this.adminCoupon.id,
                    percentOff: this.percentOff
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingPercentOff', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>