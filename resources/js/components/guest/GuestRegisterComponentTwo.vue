<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Register
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        会員登録
                    </div>
                </div>
            </v-col>
       </v-row>
       <v-row>
           <v-col cols="12" sm="12" md="4">
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <div class="form-title grey--text text--darken-4">{{guest.name}}様の会員登録</div>
                    </v-col>
                </v-row>
           </v-col>
           <v-col v-if="guest === null" cols="12" sm="12" md="8">
               <register-component></register-component>
           </v-col>
           <v-col v-if="guest !== null" cols="12" sm="12" md="8">
                <v-row>
                    <!-- <v-col cols="12" sm="12" md="4">
                        <v-img 
                            src="https://meetuni.s3-ap-northeast-1.amazonaws.com/illustration/travel-tickets-colour-1200px.png" 
                            cover 
                        >
                        </v-img>
                    </v-col> -->
                    <v-col cols="12" sm="12" md="6">
                        <v-form
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field 
                                        v-model="password"
                                        label="パスワード" 
                                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="showPassword ? 'text' : 'password'"
                                        outlined
                                        required
                                        hint="8文字以上で設定してください。"
                                        persistent-hint
                                        :rules="passwordRules" 
                                        :error="allRegisterError.password ? true : false"
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
                                        :error="allRegisterError.password_confirmation ? true : false"
                                        :error-messages="allRegisterError.password_confirmation"
                                        @click:append="showPassword2 = !showPassword2"
                                    ></v-text-field>

                                    <!-- <input type="hidden" name="timezone" :value="timezone"> -->

                                    <v-btn 
                                        block 
                                        dark 
                                        color="primary" 
                                        class="mb-4" 
                                        @click="goRegister()"
                                        :loading="loading"
                                        :disabled="disabled"
                                    >
                                            登録する
                                    </v-btn>
                                    <div v-if="allRegisterError.email !== null">
                                        <p class="error-message grey--text text--grey-4" >
                                            {{allRegisterError.email[0]}}
                                        </p>
                                        <!-- <v-btn
                                            color="primary"
                                            outlined
                                            @click="resetForm"
                                            class="mr-2"
                                        >
                                            リセットする
                                        </v-btn> -->
                                        <v-btn
                                            color="primary"
                                            outlined
                                            @click="toRegister"
                                        >
                                            最初から登録しなおす
                                        </v-btn>
                                    </div>
                                    <!-- <v-btn text color="primary" class="pa-0" @click="toLogin()">login</v-btn> -->
                                </v-col>
                            </v-row>
                            <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                            
                        </v-form>
                    </v-col>
                </v-row>
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
            password: '',
            passwordRules: [
                (v) => !!v || 'パスワードを入力してください。',
                (v) => v.length >= 8 || '最低8文字が必要です。'
            ],
            password_confirmation: '',
            confirmPasswordRules: [
                (v) => !!v || 'パスワードを再度入力してください。',
                (v) => v == this.password || 'パスワードが一致しません。'
            ],      
            // timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            showPassword: false,
            showPassword2: false
        }
    },
    computed: {
        ...mapState([
            'allRegisterError', 
            'guest',
            'loading',
        ]),
    },
    methods: {
        ...mapActions([
            'guestRegister'
        ]),
        goRegister(){    

            if(this.$refs.form.validate()){
                this.guestRegister({
                    url: "/register",
                    user_type: 1,
                    name: this.guest.name,
                    kana: this.guest.kana,
                    zipcode: this.guest.zipcode,
                    prefecture: this.guest.prefecture,
                    city: this.guest.city,
                    address_1: this.guest.address_1,
                    building: this.guest.building,
                    phone: this.guest.phone,
                    email: this.guest.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    // timezone: this.timezone
                })
            }
           
        }, 
        toRegister(){
            window.location = '/guest/register';
            this.$store.commit('setallRegisterErrors', null);
        },
        // resetForm(){
        //     this.$store.commit('setLoading', false);
        //     this.$refs.form.reset();
        //     // this.$store.commit('setDisabled', false);
        //     //this.$store.commit('setallRegisterErrors', null);
        // }
        // toLogin(){
        //     this.$router.push({name: 'student-login'});
        // }
    }


}
</script>

<style>
.error-message{
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 300;
    font-style: normal;
    font-size: 16px;
    letter-spacing: 0.03em;
}

</style>