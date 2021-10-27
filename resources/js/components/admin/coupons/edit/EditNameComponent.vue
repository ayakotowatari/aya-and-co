<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="name"
                    label="名前" 
                    outlined
                    required
                    :rules="nameRules"
                    :error="allerror ? true : false"
                    :error-messages="allerror"
                >
                </v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponName"
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
        // isEditing: Boolean
    },
    data: function(){
        return {
            valid: true,
            name: '',
            nameRules: [
                v => !!v || '名前の入力が必要です。',
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
            'updateName'
        ]),
        updateCouponName(){

            if(this.$refs.form.validate()){
                this.updateName({
                    id: this.adminCoupon.id,
                    name: this.name,
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingName', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>