<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                 <v-date-picker
                    v-model="deadline"
                    color = "primary"
                ></v-date-picker>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponDeadline"
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
            deadline: '',
            deadlineRules: [
                v => !!v || '有効期限の入力が必要です。',
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
            'updateDeadline'
        ]),
        updateCouponDeadline(){

            if(this.$refs.form.validate()){
                this.updateDeadline({
                    id: this.adminCoupon.id,
                    deadline: this.deadline
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingDeadine', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>