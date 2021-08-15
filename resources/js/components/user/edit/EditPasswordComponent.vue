<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field 
                    v-model="password"
                    label="新しいパスワード" 
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword ? 'text' : 'password'"
                    outlined
                    required
                    :rules="passwordRules" 
                    :error="allerror.password ? true : false"
                    :error-messages="allerror.password"
                    @click:append="showPassword = !showPassword"
                ></v-text-field>
                <v-text-field 
                    v-model="password_confirmation"
                    label="新しいパスワードの確認" 
                    :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword2 ? 'text' : 'password'"
                    outlined
                    required
                    :rules="confirmPasswordRules" 
                    :error="allerror.password_confirmation ? true : false"
                    :error-messages="allerror.password_confirmation"
                    @click:append="showPassword2 = !showPassword2"
                ></v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updatePassword"
                >
                    更新する
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="backPassword"
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
        isEditingPassword: Boolean,
    },
    data: function(){
        return {
            valid: true,
            password: '',
            passwordRules: [
                (v) => !!v || 'パスワードを入力してください。',
                (v) => v.length >= 8 || 'パスワードは8文字以上です。'
            ],
            password_confirmation: '',
            confirmPasswordRules: [
                (v) => !!v || '確認のためパスワードを入力してください。',
                (v) => v == this.password || 'パスワードが一致しません。'
            ],      
            showPassword: false,
            showPassword2: false
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
            'updateUserPassword'
        ]),
        updatePassword(){

            if(this.$refs.form.validate()){
                this.updateUserPassword({
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
            }
            
        },
        backPassword(){
            this.$refs.form.reset();
            this.$store.commit('setIsEditingPassword', false)
            this.$router.go({name: 'profile'})
        }
    }


}
</script>

<style>

</style>