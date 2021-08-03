<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogRegisterToOrder" 
                max-width=640
            >
                <v-card>
                    <v-container>
                    <v-row justify="center">
                        <v-col cols="10" sm="10" md="8">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <div class="page-heading">
                                                Register
                                            </div>
                                            <div class="jp-font-400 grey--text text--darken-4 mb48">会員登録をする</div>
                                        </v-col>
                                    </v-row>
                                    <v-form 
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                        class="mb48"
                                    >
                                        <v-row justify="center">
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field
                                                    v-model="name"
                                                    label="お名前" 
                                                    outlined
                                                    required
                                                    :rules="nameRules"
                                                    :error="allRegisterError.name ? true : false"
                                                    :error-messages="allRegisterError.name"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="kana"
                                                    label="フリガナ"
                                                    outlined
                                                    required
                                                    :rules="kanaRules"
                                                    :error="allRegisterError.kana ? true : false"
                                                    :error-messages="allRegisterError.kana"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="zipcode"
                                                    label="郵便番号"
                                                    outlined
                                                    required
                                                    hint="ハイフンなしで、数字7桁のみをご記入ください。例: 1234567"
                                                    persistent-hint
                                                    :rules="zipcodeRules"
                                                    :error="allRegisterError.zipcode ? true : false"
                                                    :error-messages="allRegisterError.zipcode"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="state"
                                                    label="都道府県"
                                                    outlined
                                                    required
                                                    :rules="prefectureRules"
                                                    :error="allRegisterError.prefecture ? true : false"
                                                    :error-messages="allRegisterError.prefecture"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="city"
                                                    label="市町村"
                                                    outlined
                                                    required
                                                    :rules="cityRules"
                                                    :error="allRegisterError.city ? true : false"
                                                    :error-messages="allRegisterError.city"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="address1"
                                                    label="番地・部屋番号"
                                                    outlined
                                                    required
                                                    :rules="address1Rules"
                                                    :error="allRegisterError.address_1 ? true : false"
                                                    :error-messages="allRegisterError.address_1"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="building"
                                                    label="マンション・建物名"
                                                    outlined
                                                    :error="allRegisterError.building ? true : false"
                                                    :error-messages="allRegisterError.building"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="phone"
                                                    label="電話番号"
                                                    outlined
                                                    required
                                                    :rules="phoneRules"
                                                    :error="allRegisterError.phone ? true : false"
                                                    :error-messages="allRegisterError.phone"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="email"
                                                    label="メールアドレス" 
                                                    outlined
                                                    required
                                                    :rules="emailRules" 
                                                    :error="allRegisterError.email ? true : false"
                                                    :error-messages="allRegisterError.email"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="confirmEmail"
                                                    label="メールアドレスの確認" 
                                                    outlined
                                                    required
                                                    :rules="confirmEmailRules" 
                                                    :error="allRegisterError.email ? true : false"
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

                                                <v-btn 
                                                    dark 
                                                    color="primary" 
                                                    class="mb-2" 
                                                    @click="goRegister()"
                                                    :looading="loading"
                                                >
                                                    登録する
                                                </v-btn>
                                                 <v-btn 
                                                    outlined
                                                    color="primary" 
                                                    class="mb-2" 
                                                    @click="close()"
                                                >
                                                    もどる
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
                </v-card>
            
        </v-dialog>
    </v-row>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialogRegisterToOrder: Boolean,
    },
    data: function(){
        return {
            valid: true,
            name: '',
            nameRules: [
                (v) => !!v || '名前を入力してください。',
            ],
            kana: '',
            kanaRules: [
                v => !!v || 'フリガナを入力してください。',
            ],
            zipcode: '',
            zipcodeRules: [
                v => !!v || '郵便番号を入力してください。',
                v => v.length == 7 || 'ハイフンなしで、数字7桁を入力してください。'
            ], 
            state: '',
            prefectureRules: [
                v => !!v || '都道府県を入力してください。',
            ],
            city: '',
            cityRules: [
                v => !!v || '市町村を入力してください。',
            ],
            address1: '',
            address1Rules: [
                v => !!v || '番地・部屋番号等を入力してください。',
            ],
            building: '',
            phone: '',
            phoneRules: [
                v => !!v || '電話番号を入力してください。',
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
    watch: {
        zipcode: function(val){
            if(7 != val.length){
                return;
            }

            let self = this;
            //自サイトのAPI
            let url = "/ajax/zipcode/" + val;

            axios
            .get(url)
            .then(res => {
                self.state = res.data.pref;
                self.city = res.data.address;
                // self.address1 = res.data.town;
            })
        }
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
         ...mapState([
            'allRegisterError',
            'loading'
        ])
    },
    methods: {
        ...mapActions([
            'registerToOrder'
        ]),
        goRegister(){    

            this.$store.commit('setLoading', true)
            
            if(this.$refs.form.validate()){
                this.registerToOrder({
                    url: "/register",
                    user_type: 1,
                    name: this.name,
                    kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
            }
        }, 
        close(){
            this.$store.commit('setDialogRegisterToOrder', false);
        }
    }


}
</script>

<style>
.dialog-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}

.jp-font-400-18{
  font-family: 'Noto Sans JP', sans-serif;
  letter-spacing: 0.03em;
  font-size: 18px;
}


</style>