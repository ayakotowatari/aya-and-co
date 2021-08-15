<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="zipcode"
                    label="郵便番号"
                    outlined
                    required
                    hint="ハイフンなしでご記入ください。例: 1234567"
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
                <v-btn
                    color="primary"
                    darken
                    @click="updateAddress"
                    class="mr-2"
                >
                    更新する
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="back"
                >
                    戻る
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {

    },
    data: function(){
        
        return {
            valid: true,
            zipcodeRules: [
                v => !!v || '郵便番号を入力してください。',
                v => v.length == 7 || 'ハイフンなしで、数字7桁を入力してください。'
            ], 
            prefectureRules: [
                v => !!v || '都道府県を入力してください。',
            ],
            cityRules: [
                v => !!v || '市町村を入力してください。',
            ],
            address1Rules: [
                v => !!v || '番地・部屋番号等を入力してください。',
            ],
            phoneRules: [
                v => !!v || '電話番号を入力してください。',
            ],
            
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
            'isEditingAddress',
            'user',
        ]),
        zipcode: {
            get(){                
                return this.user.zipcode
            },
            set (value) {
                this.$store.commit('updateUserZipcode', value)
            }
        },
        state: {
            get(){                
                return this.user.prefecture
            },
            set (value) {
                this.$store.commit('updateUserPrefecture', value)
            }
        },
        city: {
           get(){                
                return this.user.city
            },
            set (value) {
                this.$store.commit('updateUserCity', value)
            }
        },
        address1: {
            get(){                
                return this.user.address_1
            },
            set (value) {
                this.$store.commit('updateUserAddress1', value)
            }
        },
        building: {
            get(){                
                return this.user.building
            },
            set (value) {
                this.$store.commit('updateUserBuilding', value)
            }
        },
        phone: {
            get(){                
                return this.user.phone
            },
            set (value) {
                this.$store.commit('updateUserPhone', value)
            }
        },
    
    
    },
    methods: {
        ...mapActions([
            'updateUserAddress'
        ]),
        updateAddress(){

            if(this.$refs.form.validate()){
                this.updateUserAddress({
                    // name: this.name,
                    // kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                })
            }
            
        },
        back(){
            this.$store.commit('setIsEditingAddress', false)
            this.$store.dispatch('fetchUser')
        }

      
        
    }       
}
</script>

<style>

</style>