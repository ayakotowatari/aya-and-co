<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="type"
                    label="タイプ" 
                    outlined
                    required
                    :rules="typeRules"
                    :error="allerror ? true : false"
                    :error-messages="allerror"
                >
                </v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponType"
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
            type: '',
            typeRules: [
                v => !!v || 'タイプの入力が必要です。',
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
            'updateType'
        ]),
        updateCouponType(){

            if(this.$refs.form.validate()){
                this.updateType({
                    id: this.adminCoupon.id,
                    type: this.type,
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingType', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>