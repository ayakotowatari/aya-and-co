<template>
<div>
    <v-app>
        <!-- <passwordresetsnackbar-component
            v-bind:passwordResetSnackbar="passwordResetSnackbar"
        ></passwordresetsnackbar-component> -->
        <!-- <navbar-component></navbar-component> -->
        <v-main class="my48">
            <v-container>
                 <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <div class="heading-group">
                            <div class="page-heading">
                                Reset Password
                            </div>
                            <div class="page-subtitle grey--text text--darken-3">
                                パスワードをリセットする
                            </div>
                        </div>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

                    </v-col>
                    <v-col cols="12" sm="12" md="8">
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-form 
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                    >
                                        <!-- <input type="hidden" name="token" :value="token"> -->

                                        <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                :value="email"
                                                label="メールアドレス" 
                                                outlined
                                                readonly
                                            ></v-text-field>
                                            <v-text-field 
                                                v-model="password"
                                                label="新しいパスワード" 
                                                outlined
                                                required
                                                :rules="passwordRules" 
                                                :error="errorMessage"
                                                :error-messages="errorMessage"
                                            ></v-text-field>
                                            <v-text-field 
                                                v-model="password_confirmation"
                                                label="新しいパスワードの確認" 
                                                outlined
                                                required
                                                :rules="confirmPasswordRules" 
                                                :error="errorMessage"
                                                :error-messages="errorMessage"
                                            ></v-text-field>

                                            <v-btn 
                                                block 
                                                dark 
                                                color="primary" 
                                                class="mb-2" 
                                                @click="reset"
                                                :loading="loading"
                                                :disabled="disableInputPassword"
                                            >
                                                パスワードをリセットする
                                            </v-btn>
                                            <!-- <v-btn text color="primary" class="pa-0" @click.stop="toLogin()">ログインする</v-btn> -->
                                        </v-col>
                                    </v-row>
                                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                                </v-form>
                            </v-col>
                        </v-row>
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
    props: ['email', 'token'],
    data: function(){
        return {
            valid: true,
            // token: '',
            // email: '',
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
        }
    },
    mounted(){
        // this.$store.dispatch('fetchUser');
        // console.log(this.$route.query.email)
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
            'errorMessage',
            'loading',
            'disabled',
            'disableInputPassword',
            'passwordResetSnackbar',
            // 'user',
        ]),
    },
    methods: {
        ...mapActions([
            'resetPassword',
        ]),
       reset(){

           console.log(this.token)

           this.$store.commit('setLoading', true);

           if(this.$refs.form.validate()){
               console.log('request');

               this.resetPassword({
                   token: this.token,
                   email: this.email,
                   password: this.password,
                   password_confirmation: this.password_confirmation,
               })
               
           }

       },
    }
}
</script>

<style>
.my48 {
    margin-top: 48px;
    margin-bottom: 48px;
}

</style>