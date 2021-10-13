<template>

        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="jp-font-400 mb24">荷物の配送先のご住所</div>
                <v-form
                    ref="form1"
                    v-model="valid1"
                    lazy-validation
                >
                    <v-text-field
                        v-model="deliveryName"
                        label="お名前"
                        outlined
                        required
                        :rules="nameRules"
                        :error="allerror.name ? true : false"
                        :error-messages="allerror.name"
                        class="text-title"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryKana"
                        label="フリガナ"
                        outlined
                        required
                        :rules="kanaRules"
                        :error="allerror.kana ? true : false"
                        :error-messages="allerror.kana"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryZipcode"
                        label="郵便番号"
                        :counter="7"
                        outlined
                        required
                        hint="ハイフンなしで、数字7桁のみをご記入ください。例: 1234567"
                        persistent-hint
                        :rules="zipcodeRules"
                        :error="allerror.zipcode ? true : false"
                        :error-messages="allerror.zipcode"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryState"
                        label="都道府県"
                        outlined
                        required
                        :rules="prefectureRules"
                        :error="allerror.prefecture ? true : false"
                        :error-messages="allerror.prefecture"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryCity"
                        label="市町村"
                        outlined
                        required
                        :rules="cityRules"
                        :error="allerror.city ? true : false"
                        :error-messages="allerror.city"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryAddress1"
                        label="番地・部屋番号"
                        outlined
                        required
                        :rules="address1Rules"
                        :error="allerror.address_1 ? true : false"
                        :error-messages="allerror.address_1"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryBuilding"
                        label="マンション・建物名"
                        outlined
                        :error="allerror.building ? true : false"
                        :error-messages="allerror.building"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryPhone"
                        label="電話番号"
                        outlined
                        required
                        :rules="phoneRules"
                        :error="allerror.phone ? true : false"
                        :error-messages="allerror.phone"
                    ></v-text-field>
                    <!-- <v-select
                        v-model="deliveryDeliveryTime"
                        :items = "items"
                        label="ご希望の配達時間帯"
                        outlined
                        required
                        :rules="deliveryTimeRules" 
                        :error="allerror.delivery_time ? true : false"
                        :error-messages="allerror.delivery_time"
                    ></v-select> -->
                    <!-- <v-btn
                        color="primary"
                        outlined
                        :disabled="disabled"
                        @click="resetOther"
                    >
                    入力内容をリセットする
                    </v-btn> -->
                </v-form>
            </v-col>
             <v-col cols="12" sm="12" md="12">
                <div class="jp-font-400 mb24">お客様ご自身のご住所・ご連絡先</div>
                <v-form
                    ref="form2"
                    v-model="valid2"
                    lazy-validation
                >
                    <v-text-field
                        v-model="name"
                        :counter="10"
                        label="お名前"
                        outlined
                        required
                        :rules="nameRules"
                        :error="allerror.name"
                        :error-messages="allerror.name"
                        class="text-title"
                    ></v-text-field>
                    <v-text-field
                        v-model="kana"
                        :counter="10"
                        label="フリガナ"
                        outlined
                        required
                        :rules="kanaRules"
                        :error="allerror.kana"
                        :error-messages="allerror.kana"
                    ></v-text-field>
                    <v-text-field
                        v-model="zipcode"
                        label="郵便番号"
                        outlined
                        required
                        hint="ハイフンなしで半角数字7桁のみをご記入ください。例: 1234567"
                        persistent-hint
                        :rules="zipcodeRules"
                        :error="allerror.zipcode"
                        :error-messages="allerror.zipcode"
                    ></v-text-field>
                    <v-text-field
                        v-model="state"
                        label="都道府県"
                        outlined
                        required
                        :rules="prefectureRules"
                        :error="allerror.prefecture"
                        :error-messages="allerror.prefecture"
                    ></v-text-field>
                    <v-text-field
                        v-model="city"
                        label="市町村"
                        outlined
                        required
                        :rules="cityRules"
                        :error="allerror.city"
                        :error-messages="allerror.city"
                    ></v-text-field>
                    <v-text-field
                        v-model="address1"
                        label="番地・部屋番号"
                        outlined
                        required
                        :rules="address1Rules"
                        :error="allerror.address_1"
                        :error-messages="allerror.address_1"
                    ></v-text-field>
                    <v-text-field
                        v-model="building"
                        label="マンション・建物名"
                        outlined
                        :error="allerror.building"
                        :error-messages="allerror.building"
                    ></v-text-field>
                    <v-text-field
                        v-model="phone"
                        label="電話番号"
                        outlined
                        required
                        :rules="phoneRules"
                        :error="allerror.phone"
                        :error-messages="allerror.phone"
                    ></v-text-field>
                    <v-text-field
                        v-model="email"
                        label="メールアドレス" 
                        outlined
                        required
                        :rules="emailRules" 
                        :error="allerror.email"
                        :error-messages="allerror.email"
                    ></v-text-field>
                    <v-text-field
                        v-model="confirmEmail"
                        label="メールアドレスの確認" 
                        outlined
                        required
                        :rules="confirmEmailRules" 
                        :error="allerror.email"
                        :error-messages="allerror.email"
                    ></v-text-field>
                </v-form>
                <!-- <v-btn
                    color="primary"
                    outlined
                    :disabled="disabled"
                    @click="resetHome"
                    class="hidden-sm-and-down mb-4"
                >
                入力内容をリセットする
                </v-btn>
                <v-btn
                    color="primary"
                    outlined
                    :disabled="disabled"
                    @click="resetHome"
                    class="hidden-md-and-up mb-4"
                >
                入力内容をリセットする
                </v-btn> -->
                <!-- <v-btn
                    @click="add"
                    color="primary"
                    dark
                    :disabled="disabled"
                    class="hidden-sm-and-down"
                >
                注文内容を確認する
                </v-btn> -->
                <v-btn
                    block
                    @click="add"
                    color="primary"
                    :disabled="disabled"
                    class="mb-6"
                >
                これらの住所を使用する
                </v-btn>
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
            valid1: true,
            valid2: true,
            deliveryName: '',
            deliveryKana: '',
            deliveryZipcode: '',
            deliveryState: '',
            deliveryCity: '',
            deliveryAddress1: '',
            deliveryBuilding: '',
            deliveryPhone: '',
            deliveryDeliveryTime: '',
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
                v => v.length == 7 || 'ハイフンなしで、半角数字7桁を入力してください。例：1234567'
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
                (v) => v == this.email || 'メールアドレスがマッチしていません。'
            ],   
            deliveryTime: '',
            deliveryTimeRules: [
                v => !!v || 'ご希望の配達時間を選択してください。',
            ],
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
        }
    },
    watch: {
        deliveryZipcode: function(val){
            if(7 != val.length){
                return;
            }

            let self = this;
            //自サイトのAPI
            let url = "/ajax/zipcode/" + val;

            axios
            .get(url)
            .then(res => {
                self.deliveryState = res.data.pref;
                self.deliveryCity = res.data.address;
                // self.address1 = res.data.town;
            })
        },
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
            'allerror',
            'disabled',
        ])
    
    },
    methods: {
        ...mapActions([
            'addGuestAndOtherAddress',
        ]),
        add(){

            if(this.$refs.form1.validate() && this.$refs.form2.validate()){

                let deliveryAddress = {
                    name: this.deliveryName,
                    kana: this.deliveryKana,
                    zipcode: this.deliveryZipcode,
                    prefecture: this.deliveryState,
                    city: this.deliveryCity,
                    address_1: this.deliveryAddress1,
                    building: this.deliveryBuilding,
                    phone: this.deliveryPhone,
                    // delivery_time: this.deliveryDeliveryTime,
                }

                this.addGuestAndOtherAddress({
                    deliveryAddress: deliveryAddress,
                    // deliveryPrefecture: this.deliveryState,
                    name: this.name,
                    kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                    email: this.email,
                })
            }
        },
        resetOther(){
            this.$refs.form1.reset();
        },
        resetHome(){
            this.$refs.form2.reset();
        }
    }       
}
</script>

<style>
.jp-font{
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 500;
    font-style: normal;
    letter-spacing: 0.03em;
}

.mb24{
    margin-bottom:24px;
}

</style>