<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="email"
                    label="新しいメールアドレス" 
                    outlined
                    required
                    :rules="emailRules"
                    :error="allerror.email ? true : false"
                    :error-messages="allerror.email"
                >
                </v-text-field>
                 <v-text-field
                    v-model="confirmEmail"
                    label="新しいメールアドレスの確認" 
                    outlined
                    required
                    :rules="confirmEmailRules" 
                    :error="allerror.email ? true : false"
                    :error-messages="allerror.email"
                ></v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateEmail"
                >
                    更新する
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="backEmail"
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
        user: Object,
        isEditingEmail: Boolean,
    },
    data: function(){
        return {
            valid: true,
            email: '',
            emailRules: [
                (v) => !!v || 'メールを入力してください。',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'メールアドレスが正しくありません。'
            ],
            confirmEmail: '',
            confirmEmailRules: [
                (v) => !!v || 'メールアドレスの確認が必要です。',
                (v) => v == this.email || 'メールアドレスが一致していません。'
            ],   
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'allerror',
        ]),
    },
    methods: {
        ...mapActions([
            'updateUserEmail'
        ]),
        updateEmail(){

            if(this.$refs.form.validate()){
                this.updateUserEmail({
                email: this.email,
            })
            }
            
        },
        backEmail(){
            this.$refs.form.reset();
            this.$store.commit('setIsEditingEmail', false)
            this.$router.go({name: 'profile'})
        }
    }


}
</script>

<style>

</style>