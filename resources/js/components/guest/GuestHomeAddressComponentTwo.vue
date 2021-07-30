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
                        :counter="7"
                        label="郵便番号"
                        outlined
                        required
                        hint="ハイフンなしで、数字7桁のみをご記入ください。例: 1234567"
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
                    <v-select
                        v-model="deliveryTime"
                        :items = "items"
                        label="ご希望の配達時間帯"
                        outlined
                        required
                        :rules="deliveryTimeRules" 
                        :error="allerror.delivery_time ? true : false"
                        :error-messages="allerror.delivery_time"
                    ></v-select>
                    <!-- <v-btn
                        color="primary"
                        outlined
                        :disabled="disabled"
                        @click="reset"
                        class="hidden-sm-and-down mb-4"
                    >
                    入力内容をリセットする
                    </v-btn>
                    <v-btn
                        color="primary"
                        outlined
                        block
                        :disabled="disabled"
                        @click="reset"
                        class="hidden-md-and-up mb-4"
                    >
                    入力内容をリセットする
                    </v-btn> -->
                    <v-btn
                        block
                        @click="add"
                        color="primary"
                        dark
                        class="mb-6"
                        :disabled="disabled"
                    >
                    注文内容を確認する
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
            items: ["希望なし", "9:00-12:00", "12:00-14:00", "14:00-16:00"],
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
                    delivery_time: this.deliveryTime
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