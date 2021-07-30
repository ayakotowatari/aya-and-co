<template>
    <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Order
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    ご購入の手続き
                  </div>
              </div>
          </v-col>
        </v-row>
         <v-row justify="center" v-if="user !== null">
            <v-col cols="12" sm="12" md="4">
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <v-row justify="center">
                            <v-col cols="12" sm="12" md="12">
                                <div class="form-title grey--text text--darken-4 mb24">自宅住所を編集する</div>
                            </v-col>
                        </v-row>
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
                            <v-row>
                                <v-col cols="12" sm="12" md="6">
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
                                
                                <v-col cols="12" sm="12" md="6">
                                    <div class="link">
                                        <router-link :to="{
                                            path: '/check-address',
                                            }"
                                        >
                                            <v-btn
                                                color="primary"
                                                block
                                                outlined
                                                @click.native="scrollToTop"
                                            >
                                                戻る
                                            </v-btn>
                                        </router-link>
                                    </div>
                                </v-col>
                                
                            </v-row>
                        </v-form>
                    </v-col>
                </v-row>
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

      
        
    }       
}
</script>

<style>

</style>