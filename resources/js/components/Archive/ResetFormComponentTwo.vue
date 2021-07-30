<template>
<div>
    <v-app>
        <!-- <passwordresetsnackbar-component
            v-bind:passwordResetSnackbar="passwordResetSnackbar"
        ></passwordresetsnackbar-component> -->
        <navbar-component></navbar-component>
        <v-main class="mb48">
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
                            <form method="POST" action="/password/reset">
                        <input type="hidden" name="token" :value="token">

                        <v-row justify="center">
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field
                                    outlined
                                    type="email"
                                    name="email"
                                    label="E-mail Address"
                                    :value="email"
                                    required
                                    autocomplete="email"
                                    placeholder="example@example.com"
                                    autofocus
                                    readonly
                                ></v-text-field>
                                <v-text-field
                                    outlined
                                    label="New Password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                ></v-text-field>
                                <v-text-field
                                    outlined
                                    label="Confirm New Password"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                ></v-text-field>
                                <v-btn type="submit" color="primary" text class="btn btn-link pa-0">
                                    パスワードをリセットする
                                </v-btn>
                            </v-col>
                        </v-row>
                    </form>
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

        console.log(this.token);
        console.log(this.email);
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
    //    resetPassword(){

    //        console.log(this.token)

    //        this.$store.commit('setLoading', true);

    //        if(this.$refs.form.validate()){
    //            this.resetPassword({
    //                token: this.token,
    //                email: this.email,
    //                password: this.password,
    //                password_confirmation: this.password_confirmation,
    //            })
               
    //        }

    //    },
    }
}
</script>

<style>

</style>