<template>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-text-field
                        v-model="name"
                        label="お名前"
                        outlined
                        required
                        :rules="nameRules"
                        :error="allerror.name ? true : false"
                        :error-messages="allerror.name"
                    ></v-text-field>
                    <v-text-field
                        v-model="kana"
                        label="フリガナ"
                        outlined
                        required
                        :rules="kanaRules"
                        :error="allerror.kana ? true : false"
                        :error-messages="allerror.kana"
                    ></v-text-field>
                    <v-text-field
                        v-model="zipcode"
                        label="郵便番号"
                        outlined
                        required
                        hint="ハイフンなしで、半角数字7桁のみをご記入ください。例: 1234567"
                        persistent-hint
                        :rules="zipcodeRules"
                        :error="allerror.zipcode ? true : false"
                        :error-messages="allerror.zipcode"
                    ></v-text-field>
                    <v-text-field
                        v-model="state"
                        label="都道府県"
                        outlined
                        required
                        :rules="prefectureRules"
                        :error="allerror.prefecture ? true : false"
                        :error-messages="allerror.prefecture"
                    ></v-text-field>
                    <v-text-field
                        v-model="city"
                        label="市町村"
                        outlined
                        required
                        :rules="cityRules"
                        :error="allerror.city ? true : false"
                        :error-messages="allerror.city"
                    ></v-text-field>
                    <v-text-field
                        v-model="address1"
                        label="番地・部屋番号"
                        outlined
                        required
                        :rules="address1Rules"
                        :error="allerror.address_1 ? true : false"
                        :error-messages="allerror.address_1"
                    ></v-text-field>
                    <v-text-field
                        v-model="building"
                        label="マンション・建物名"
                        outlined
                        :error="allerror.building ? true : false"
                        :error-messages="allerror.building"
                    ></v-text-field>
                    <v-text-field
                        v-model="phone"
                        label="電話番号"
                        outlined
                        required
                        :rules="phoneRules"
                        :error="allerror.phone ? true : false"
                        :error-messages="allerror.phone"
                    ></v-text-field>
                    <v-text-field
                        v-model="email"
                        label="メールアドレス" 
                        outlined
                        required
                        :rules="emailRules"
                        :error="allerror.email ? true : false"
                        :error-messages="allerror.email"
                    ></v-text-field>
                    <v-text-field
                        v-model="confirmEmail"
                        label="メールアドレスの確認" 
                        outlined
                        required
                        :rules="confirmEmailRules" 
                        :error="allerror.email ? true : false"
                        :error-messages="allerror.email"
                    ></v-text-field>
                    <v-btn
                        block
                        @click="add"
                        color="primary"
                        class="mb-6"
                        :disabled="disabled.guestHomeAddress"
                    >
                    この住所に送る
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        
    },
    data: function(){
        
        return {
            valid: true,
            type: '',
            name: '',
            nameRules: [
                v => !!v || 'お名前を入力してください。',
            ],
            kana: '',
            kanaRules: [
                v => !!v || 'フリガナを入力してください。',
            ],
            zipcode: '',
            zipcodeRules: [
                v => !!v || '郵便番号を入力してください。',
                v => v.length == 7 || 'ハイフンなしで、半角数字7桁のみを入力してください。例：1234567'
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
                (v) => !!v || 'メールアドレスを入力してください。',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'メールアドレスが正しく入力されていません。'
            ],
            confirmEmail: '',
            confirmEmailRules: [
                (v) => !!v || 'メールアドレスの確認が必要です。',
                (v) => v == this.email || 'メールアドレスが一致していません。'
            ],   
            deliveryTime: '',
            deliveryTimeRules: [
                v => !!v || 'ご希望の配達時間を選択してください。',
            ],
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
        }
    },
    watch: {
        zipcode: function(val){
            if(7 != val.length){
                return
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
            'allerror',
            'disabled',
        ])
    
    },
    methods: {
        ...mapActions([
            'addGuest',
        ]),
        add(){

            if(this.$refs.form.validate()){
                this.addGuest({
                    type: 0,
                    name: this.name,
                    kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                    email: this.email,
                    // delivery_time: this.deliveryTime
                })
            }
            
        },
        reset(){
            this.$refs.form.reset();
        }

      
        
    }       
}
</script>

<style>

</style>