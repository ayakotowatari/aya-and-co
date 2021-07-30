<template>
<div>
    <v-app>
        <navbar-component></navbar-component>
        <v-main class="mb48">
            <v-container>
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <div class="heading-group">
                            <div class="page-heading">
                                Login
                            </div>
                            <div class="page-subtitle grey--text text--darken-3">
                                ログイン
                            </div>
                        </div>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

                    </v-col>
                    <v-col cols="12" sm="12" md="8">
                        <div>
                        <v-form 
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-row>
                                <v-col cols="12" sm="12" md="6">
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
                                        @click:append="showPassword = !showPassword"
                                        :rules="passwordRules" 
                                        :error="allLoginError.password ? true : false"
                                        :error-messages="allLoginError.password"
                                    ></v-text-field>
                                    <div class="mb-1">
                                        <v-row>
                                            <v-col cols="12" sm="12" md="12" class="hidden-sm-and-down">
                                                <v-btn dark block color="primary" @click="goLogin()">ログインする</v-btn>
                                            </v-col>
                                            <!-- <v-col cols="12" sm="12" md="3" class="hidden-sm-and-down">
                                                <v-btn outlined color="primary" @click="reset">入力内容をリセットする</v-btn>
                                            </v-col> -->
                                            <v-col cols="12" sm="12" md="12" class="hidden-md-and-up">
                                                <v-btn block dark color="primary" @click="goLogin()">ログインする</v-btn>
                                            </v-col>
                                            <!-- <v-col cols="12" sm="12" md="3" class="hidden-md-and-up">
                                                <v-btn block outlined color="primary" @click="reset">入力内容をリセットする</v-btn>
                                            </v-col> -->
                                        </v-row>
                                    </div>
                                    <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <v-btn text color="grey darken-1" class="pa-0 mr-4" @click="toRegister()">会員登録する</v-btn>
                                            <v-btn text color="grey darken-1" class="pa-0" @click="toReset()">パスワードを忘れましたか？</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                            <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                        </v-form>
                        </div>
                    </v-col>
                </v-row>
                    
            </v-container>
        </v-main>
        <footer-component></footer-component>
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
        this.$store.dispatch('fetchUser');
    },
    created(){
      // this.$store.dispatch('fetchProducts');  

        // this.fetchProducts();

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
        ...mapState([
            'allLoginError',
            'user',
        ]),
    },
    methods: {
        ...mapActions([
            'login',
        ]),
        goLogin(){

            if(this.$refs.form.validate()){
                this.login({
                    url: "/login",
                    email: this.email,
                    password: this.password,
                })
            }
        },
        toRegister(){
            window.location = "/guest/register"
        },
        toReset(){
            // window.location.href = "/password/reset";
            this.$router.push({name: 'request-reset'});
        }
    }
}
</script>

<style>

</style>