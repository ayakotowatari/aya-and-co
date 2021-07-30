<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
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
                    <v-select
                        v-model="deliveryTime"
                        :items = "items"
                        label="ご希望の配達時間帯"
                        outlined
                        required
                    ></v-select>
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
                </v-form>
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
            type: '',
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
            'disabled'
        ])
    
    },
    methods: {
        ...mapActions([
            'addGuest',
        ]),
        add(){
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

      
        
    }       
}
</script>

<style>

</style>