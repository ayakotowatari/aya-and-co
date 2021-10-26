<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="value"
                    label="割引額" 
                    outlined
                    required
                    :rules="valueRules"
                    :error="allerror ? true : false"
                    :error-messages="allerror"
                >
                </v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponValue"
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
            value: '',
            valueRules: [
                v => !!v || '割引額の入力が必要です。',
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
            'updateValue'
        ]),
        updateCouponValue(){

            if(this.$refs.form.validate()){
                this.updateValue({
                    id: this.adminCoupon.id,
                    value: this.value,
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingValue', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>