<template>
    <div class="pt-6">
        <!-- <v-row>
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
        </v-row> -->
        <!-- <v-row justify="center">
            <v-col cols="12" sm="12" md="4" v-for="item in cart" :key="item.id">
                <v-card
                        class="mx-auto"
                        max-width="390"
                        outlined
                    >
                    <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mt-1 mb-1">
                        {{item.name}} 
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            {{item.size}}g
                        </v-list-item-subtitle>
                        <v-row align="center">
                            <v-col cols="3" sm="3" md="3" >
                                {{item.quantity}}個
                            </v-col>
                            <v-col cols="3" sm="3" md="3">
                                ¥{{ cartLineTotal(item) }}
                            </v-col>
                        </v-row>
                    </v-list-item-content>
                    <v-list-item-avatar
                        tile
                        size="80"
                        color="grey"
                    ></v-list-item-avatar>
                    </v-list-item>
                </v-card>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <span>
                    合計金額（税込・送料別）：
                </span>
                <span v-text="cartTotal"></span>
            </v-col>
        </v-row> -->
        <v-row justify="center">
           
                    <v-col cols="12" sm="12" md="6">
                        <div class="form-title grey--text text--darken-4">配送先の住所を確認・指定する</div>
                    </v-col>
        </v-row>
        <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <v-tabs v-model="tab" class="mb-12">
                            <v-tab
                                href="#tab-1"
                            >
                                ご自宅に送る
                            </v-tab>
                            <v-tab
                                href="#tab-2"
                            >
                                他の住所に送る
                            </v-tab>
                            <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
                        </v-tabs>

                        <v-tabs-items v-model="tab">
                            <v-tab-item 
                                value="tab-1"
                            >
                                <homeaddress-component></homeaddress-component>
                            </v-tab-item>
                            <v-tab-item
                                value="tab-2"
                            >
                                <otheraddress-component></otheraddress-component>
                            </v-tab-item>
                        </v-tabs-items>
                    </v-col>
                </v-row>
           
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

// import OtherAddress from './OtherAddressComponent'

export default {
    components: {
        // HomeAddress,
        // OtherAddress,
    },
    props: {
    
    },
    data: function(){
        return{
            tab: null,
            items: ["9:00-12:00", "12:00-14:00", "14:00-16:00"],
            deliveryTime: '',
        }
    },
    created(){

    },
    computed: {
        ...mapState([
            'user',
            'cart',
            'deliveryAddress',
            'allerror',
        ]),
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        name: {
            get(){                
                return this.user.name
            },
            set (value) {
                this.$store.commit('updateDeliveryName', value)
            }
        },
        kana: {
            get(){                
                return this.user.kana
            },
            set (value) {
                this.$store.commit('updateDeliveryKana', value)
            }
        },
        zipcode: {
            get(){                
                return this.user.zipcode
            },
            set (value) {
                this.$store.commit('updateDeliveryZipcode', value)
            }
        },
        state: {
            get(){                
                return this.user.prefecture
            },
            set (value) {
                this.$store.commit('updateDeliveryPrefecture', value)
            }
        },
        city: {
           get(){                
                return this.user.city
            },
            set (value) {
                this.$store.commit('updateDeliveryCity', value)
            }
        },
        address1: {
            get(){                
                return this.user.address_1
            },
            set (value) {
                this.$store.commit('updateDeliveryAddress1', value)
            }
        },
        building: {
            get(){                
                return this.user.building
            },
            set (value) {
                this.$store.commit('updateDeliveryBuilding', value)
            }
        },
        phone: {
            get(){                
                return this.user.phone
            },
            set (value) {
                this.$store.commit('updateDeliveryPhone', value)
            }
        },
    },
    methods: {
        ...mapActions([
            'addDeliveryAddress'
        ]),
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        confirmOrder(){

            let delivery_time = this.deliveryTime;
            this.$store.commit('setDeliveryTime', delivery_time); 

            this.addDeliveryAddress({
                name: this.deliveryAddress.name,
                kana: this.deliveryAddress.kana,
                zipcode: this.deliveryAddress.zipcode,
                prefecture: this.deliveryAddress.prefecture,
                city: this.deliveryAddress.city,
                address_1: this.deliveryAddress.address_1,
                building: this.deliveryAddress.building,
                phone: this.deliveryAddress.phone,
                delivery_time: this.deliveryAddress.delivery_time
                
            })
        }
    },
}
</script>

<style>

</style>