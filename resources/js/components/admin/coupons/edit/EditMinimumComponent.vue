<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="minimum"
                    label="最低累計金額" 
                    outlined
                    required
                    :rules="minimumRules"
                    :error="allerror ? true : false"
                    :error-messages="allerror"
                >
                </v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponMinimum"
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
            minimum: '',
            minimumRules: [
                v => !!v || '最低金額の入力が必要です。',
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
            'updateMinimum'
        ]),
        updateCouponMinimum(){

            if(this.$refs.form.validate()){
                this.updateMinimum({
                    id: this.adminCoupon.id,
                    minimum: this.minimum
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingMinimum', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>