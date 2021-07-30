<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Register
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        管理者登録
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-form 
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                v-model="name"
                                label="お名前" 
                                outlined
                                required
                                :rules="nameRules"
                                :error="allRegisterError.name"
                                :error-messages="allRegisterError.name"
                            ></v-text-field>
                            <v-text-field
                                v-model="email"
                                label="メールアドレス" 
                                outlined
                                required
                                :rules="emailRules" 
                                :error="allRegisterError.email"
                                :error-messages="allRegisterError.email"
                            ></v-text-field>
                            <v-text-field
                                v-model="confirmEmail"
                                label="メールアドレスの確認" 
                                outlined
                                required
                                :rules="confirmEmailRules" 
                                :error="allRegisterError.email"
                                :error-messages="allRegisterError.email"
                            ></v-text-field>
                            <v-text-field 
                                v-model="password"
                                label="パスワード" 
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                outlined
                                required
                                :rules="passwordRules" 
                                :error="allRegisterError.password"
                                :error-messages="allRegisterError.password"
                                @click:append="showPassword = !showPassword"
                            ></v-text-field>
                            <v-text-field 
                                v-model="password_confirmation"
                                label="パスワードの確認" 
                                :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword2 ? 'text' : 'password'"
                                outlined
                                required
                                :rules="confirmPasswordRules" 
                                :error="allRegisterError.password_confirmation"
                                :error-messages="allRegisterError.password_confirmation"
                                @click:append="showPassword2 = !showPassword2"
                            ></v-text-field>

                            <v-btn block dark color="primary" class="mb-2" @click="goRegister()">登録する</v-btn>
                            <!-- <v-btn text color="primary" class="pa-0" @click.stop="toLogin()">ログインする</v-btn> -->
                        </v-col>
                    </v-row>
                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                    
                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function(){
        return{
            valid: true,
            name: '',
            nameRules: [
                (v) => !!v || '名前を入力してください。',
            ],
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
    computed: {
        ...mapState('admin', [
            'allRegisterError'
        ])
    },
    methods: {
        ...mapActions('admin', [
            'register'
        ]),
        goRegister(){    

            if(this.$refs.form.validate()){
                this.register({
                    url: "/admin/register",
                    user_type: 5,
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
            }
            
        }, 
        // toLogin(){
        //     // this.$router.push({name: 'admin-login'});
        //     window.location = "/admin/login"
        // }
    }


}
</script>

<style>

</style>
        
  