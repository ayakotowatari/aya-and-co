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
                        <div class="form-title grey--text text--darken-4">会員登録をする</div>
                    </v-col>
                </v-row>
           </v-col>
           <v-col cols="12" sm="12" md="8">
                <v-row>
                    <!-- <v-col cols="12" sm="12" md="4">
                        <v-img 
                            src="https://meetuni.s3-ap-northeast-1.amazonaws.com/illustration/travel-tickets-colour-1200px.png" 
                            cover 
                        >
                        </v-img>
                    </v-col> -->
                    <v-col cols="12" sm="12" md="12">
                        <v-form>
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
                                        v-model="kana"
                                        label="フリガナ" 
                                        outlined
                                        required
                                        :rules="kanaRules"
                                        :error="allRegisterError.kana"
                                        :error-messages="allRegisterError.kana"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="zipcode"
                                        label="郵便番号"
                                        outlined
                                        required
                                        hint="ハイフンなしでご記入ください。例: 1234567"
                                        persistent-hint
                                        :rules="kanaRules"
                                        :error="allRegisterError.zipcode"
                                        :error-messages="allRegisterError.zipcode"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="state"
                                        label="都道府県"
                                        outlined
                                        required
                                        :error="allRegisterError.prefecture"
                                        :error-messages="allRegisterError.prefecture"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="city"
                                        label="市町村"
                                        outlined
                                        required
                                        :error="allRegisterError.city"
                                        :error-messages="allRegisterError.city"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="address_1"
                                        label="番地・部屋番号"
                                        outlined
                                        required
                                        :error="allRegisterError.address_1"
                                        :error-messages="allRegisterError.address_1"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="building"
                                        label="マンション・建物名"
                                        outlined
                                        :error="allRegisterError.building"
                                        :error-messages="allRegisterError.building"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="phone"
                                        label="電話番号"
                                        outlined
                                        required
                                        :error="allRegisterError.phone"
                                        :error-messages="allRegisterError.phone"
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
                                        v-model="password"
                                        label="パスワード" 
                                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="showPassword ? 'text' : 'password'"
                                        outlined
                                        required
                                        hint="8文字以上で設定してください。"
                                        persistent-hint
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

                                    <!-- <input type="hidden" name="timezone" :value="timezone"> -->

                                    <v-btn block dark color="primary" class="mb-2" @click="goRegister()">登録する</v-btn>
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
            nameRules: [
                v => !!v || 'Name is required',
            ],
            kanaRules: [
                v => !!v || 'Kana is required',
            ],
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            password: '',
            passwordRules: [
                (v) => !!v || 'Password is required',
                (v) => v.length >= 8 || 'Minimum 8 characters'
            ],
            password_confirmation: '',
            confirmPasswordRules: [
                (v) => !!v || 'Confirmation Password is required',
                (v) => v == this.password || 'Password must match'
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
        ]),
        name: {
            get(){
                if(this.guest !==null){
                    return this.guest.name
                }else{
                    return null
                }
            },
            set (value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestName', value)
                }
            }
        },
        kana: {
            get(){
                if(this.guest !==null){
                    return this.guest.kana
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestKana', value)
                }
            }
        },
        zipcode: {
            get(){
                if(this.guest !==null){
                    return this.guest.zipcode
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestZipcode', value)
                }
            }
        },
        state: {
            get(){
                if(this.guest !==null){
                    return this.guest.prefecture
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestPrefecture', value)
                }
            }
        },
        city: {
            get(){
                if(this.guest !==null){
                    return this.guest.city
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                     this.$store.commit('updateGuestCity', value)
                }
            }
        },
        address_1: {
            get(){
                if(this.guest !==null){
                    return this.guest.address_1
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                     this.$store.commit('updateGuestAddress1', value)
                }
            }
        },
        building: {
            get(){
                if(this.guest !==null){
                    return this.guest.building
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestBuilding', value)
                }
            }
        },
        phone: {
            get(){
                if(this.guest !==null){
                    return this.guest.phone
                }else{
                    return null
                }
            },
            set(value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestPhone', value)
                }
            }
        },
        email: {
            get(){
                if(this.guest !==null){
                    return this.guest.email
                }else{
                    return null
                }
            },
            set (value) {
                if(this.guest !==null){
                    this.$store.commit('updateGuestEmail', value)
                }
            }
        },

    },
    methods: {
        ...mapActions([
            'guestRegister'
        ]),
        goRegister(){    
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
        }, 
        // toLogin(){
        //     this.$router.push({name: 'student-login'});
        // }
    }


}
</script>

<style>

</style>