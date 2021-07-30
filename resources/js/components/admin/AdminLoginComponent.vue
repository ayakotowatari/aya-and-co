<template>
    <div>
        <v-app>
            <homenavbar-component></homenavbar-component>
            <v-main>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <div class="heading-group">
                                <div class="page-heading">
                                    Admin Login
                                </div>
                                <div class="page-subtitle grey--text text--darken-3">
                                    管理者ログイン
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
                                            v-model="email"
                                            label="メールアドレス" 
                                            outlined
                                            required
                                            :rules="emailRules" 
                                            :error="allLoginError.email ? true : false"
                                            :error-messages="allLoginError.email"
                                        ></v-text-field>
                                        <v-text-field 
                                            v-model="password"
                                            label="パスワード" 
                                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                            :type="showPassword ? 'text' : 'password'"
                                            outlined
                                            required
                                            :rules="passwordRules" 
                                            :error="allLoginError.password ? true : false"
                                            :error-messages="allLoginError.password"
                                            @click:append="showPassword = !showPassword"
                                        ></v-text-field>
                                        <v-btn block depressed dark color="primary" class="mb-2" @click="goLogin()">ログイン</v-btn>
                                        <v-row justify="center">
                                            <v-col cols="12" sm="12" md="12">
                                                <v-btn text color="grey darken-1" class="pa-0" @click="toReset()">パスワードを忘れましたか?</v-btn>
                                            </v-col>
                                        </v-row>
                                        </v-col>
                                    </v-row>
                                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                                </v-form>
                            </v-col>
                        </v-row>
                </v-container>
            </v-main>
        </v-app>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function(){
        return {
            valid: true,
            email: '',
            emailRules: [
                (v) => !!v || 'メールアドレスを入力してください。',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'メールアドレスが正しく入力されていません。'
            ],
            password: '',
            passwordRules: [
                (v) => !!v || 'パスワードを入力してください。',
                (v) => v.length >= 8 || 'パスワードは8文字以上です。'
            ],
            showPassword: false,
        }
    },
    mounted(){
      
    },
    created(){
      // this.$store.dispatch('fetchProducts');  

        // this.fetchProducts();

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
        ...mapState('admin', [,
            'allLoginError',
        ]),
    },
    methods: {
        ...mapActions('admin', [,
            'login',
        ]),
        goLogin(){

            if(this.$refs.form.validate()){
                this.login({
                    url: "/admin/login",
                    email: this.email,
                    password: this.password,
                })
            }
        },
        // reset(){
        //     this.$refs.form.reset();
        // }
    }
}
</script>

<style>

</style>