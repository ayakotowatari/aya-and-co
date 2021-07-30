<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogEditAddress" 
                max-width=560
            >
                <v-card>
                    <v-container>
                    <v-row justify="center" v-if="user !== null">
                        <v-col cols="12" sm="12" md="8">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <div class="jp-font-400-18 grey--text text--darken-4 mt48 mb48">自宅住所を編集する</div>
                                        </v-col>
                                    </v-row>
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
                                            class="text-title"
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
                                            hint="記号とハイフンなしで、数字7桁のみをご記入ください。例: 1234567"
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
                                        <v-row class="mb48">
                                            <v-col cols="6" sm="6" md="6">
                                                <v-btn
                                                    color="primary"
                                                    block
                                                    darken
                                                    @click="update"
                                                    :loading="loading"
                                                    class="mb24"
                                                >
                                                更新する
                                                </v-btn>
                                            </v-col>
                                            
                                            <v-col cols="6" sm="6" md="6">
                                                <div class="link">
                                                    <v-btn
                                                        color="primary"
                                                        block
                                                        outlined
                                                        @click="back"
                                                    >
                                                        戻る
                                                    </v-btn>
                                                </div>
                                            </v-col>
                                            
                                        </v-row>
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
        dialogEditAddress: Boolean,
    },
    data: function(){
        return {
            valid: true,
            nameRules: [
                v => !!v || 'お名前を入力してください。',
            ],
            kanaRules: [
                v => !!v || 'フリガナを入力してください。',
            ],
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
            'loading',
            'user',
        ]),
        name: {
            get(){                
                return this.user.name
            },
            set (value) {
                this.$store.commit('updateUserName', value)
            }
        },
        kana: {
            get(){                
                return this.user.kana
            },
            set (value) {
                this.$store.commit('updateUserKana', value)
            }
        },
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
            'updateAddress'
        ]),
        scrollToTop(){
          window.scrollTo(0,0);
        },
        update(){

            if(this.$refs.form.validate()){

                this.updateAddress({
                    name: this.name,
                    kana: this.kana,
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
            this.$store.dispatch("dialogEditAddress", false);
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