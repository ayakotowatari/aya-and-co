<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="jp-font-400 mb24">荷物の配送先のご住所</div>
                <v-form>
                    <v-text-field
                        v-model="deliveryName"
                        :counter="10"
                        label="お名前"
                        outlined
                        required
                        class="text-title"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryKana"
                        :counter="10"
                        label="フリガナ"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryZipcode"
                        label="郵便番号"
                        outlined
                        required
                        hint="ハイフンなしでご記入ください。例: 1234567"
                        persistent-hint
                        :error="allerror.zipcode"
                        :error-messages="allerror.zipcode"
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryState"
                        label="都道府県"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryCity"
                        label="市町村"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryAddress1"
                        label="番地・部屋番号"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryBuilding"
                        label="マンション・建物名"
                        outlined
                    ></v-text-field>
                    <v-text-field
                        v-model="deliveryPhone"
                        label="電話番号"
                        outlined
                        required
                    ></v-text-field>
                    <v-select
                        v-model="deliveryDeliveryTime"
                        :items = "items"
                        label="ご希望の配達時間帯"
                        outlined
                        required
                    ></v-select>
                </v-form>
            </v-col>
             <v-col cols="12" sm="12" md="12">
                <div class="jp-font-400 mb24">お客様ご自身のご住所・ご連絡先</div>
                <v-form>
                    <v-text-field
                        v-model="name"
                        :counter="10"
                        label="お名前"
                        outlined
                        required
                        class="text-title"
                    ></v-text-field>
                    <v-text-field
                        v-model="kana"
                        :counter="10"
                        label="フリガナ"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="zipcode"
                        label="郵便番号"
                        outlined
                        required
                        hint="ハイフンなしでご記入ください。例: 1234567"
                        persistent-hint
                        :error="allerror.zipcode"
                        :error-messages="allerror.zipcode"
                    ></v-text-field>
                    <v-text-field
                        v-model="state"
                        label="都道府県"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="city"
                        label="市町村"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="address1"
                        label="番地・部屋番号"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="building"
                        label="マンション・建物名"
                        outlined
                    ></v-text-field>
                    <v-text-field
                        v-model="phone"
                        label="電話番号"
                        outlined
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="email"
                        label="メールアドレス" 
                        outlined
                        required
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
                <v-btn
                    @click="add"
                    color="primary"
                    block
                    depressed
                    dark
                    :disabled="disabled"
                >
                注文内容を確認する
                </v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        
    },
    data: function(){
        
        return {
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
            kana: '',
            zipcode: '',
            state: '',
            city: '',
            address1: '',
            building: '',
            phone: '',
            email: '',
            confirmEmail: '',
            confirmEmailRules: [
                (v) => !!v || 'メールアドレスの確認が必要です。',
                (v) => v == this.email || 'メールアドレスがマッチしていません。'
            ],   
            deliveryTime: '',
            items: ["9:00-12:00", "12:00-14:00", "14:00-16:00"],
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
            this.addGuestAndOtherAddress({
                deliveryName: this.deliveryName,
                deliveryKana: this.deliveryKana,
                deliveryZipcode: this.deliveryZipcode,
                deliveryPrefecture: this.deliveryState,
                deliveryCity: this.deliveryCity,
                deliveryAddress_1: this.deliveryAddress1,
                deliveryBuilding: this.deliveryBuilding,
                deliveryPhone: this.deliveryPhone,
                deliveryDeliveryTime: this.deliveryDeliveryTime,
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