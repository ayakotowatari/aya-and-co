<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <h4 class="jp-font grey--text text--darken-3 mb24">Step 1: 自宅住所を確認する</h4>
                <v-card
                    class="mb24"
                    max-width="480"
                    outlined

                >
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-subtitle class="jp-font-400">郵便番号</v-list-item-subtitle>
                        <v-list-item-title class="jp-font-400">〒{{user.zipcode}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-subtitle class="jp-font-400">ご住所</v-list-item-subtitle>
                        <v-list-item-title class="jp-font-400">{{user.prefecture}}{{user.city}}{{user.address_1}}</v-list-item-title>
                        <v-list-item-title class="jp-font-400" v-if="user.building !==null">{{user.building}}</v-list-item-title>
                        <v-list-item-title class="jp-font-400">{{user.name}}様</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-subtitle class="jp-font-400">お電話番号</v-list-item-subtitle>
                        <v-list-item-title class="jp-font-400">{{user.phone}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                 <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-subtitle class="jp-font-400">メールアドレス</v-list-item-subtitle>
                        <v-list-item-title class="jp-font-400">{{user.email}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                </v-card>
            </v-col>
        </v-row>
        <div class="link">
            <router-link
                :to="{
                    name: 'edit-home',
                }"
            >
                <v-btn 
                    outlined
                    color="primary"
                    class="mb-10"
                    @click.native="scrollToTop"
                >
                    編集する
                </v-btn>
            </router-link>
        </div>
        <v-row>
            <v-col cols="12" sm="12" md="8">
                <h4 class="jp-font grey--text text--darken-3 mb24">Step 2: ご希望の配達時間を指定する</h4>
                <v-form>
                    <v-select
                        v-model="deliveryTime"
                        :items = "items"
                        label="ご希望の配達時間帯"
                        outlined
                        required
                        class="mb48"
                    ></v-select>
                    <v-btn
                        color="primary"
                        block
                        dark
                        @click="confirm"
                    >
                    確定して次へすすむ
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
            'deliveryAddress',
            'user',
        ]),
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
            'addDeliveryAddress',
        ]),
        scrollToTop(){
          window.scrollTo(0,0);
        },
        editAddress(){

            this.$router.push({name: "edit-home"})
                
        },
        confirm(){

            let delivery_time = this.deliveryTime;
            this.$store.commit('setDeliveryTime', delivery_time); 

            this.addDeliveryAddress({
                name: this.user.name,
                kana: this.user.kana,
                zipcode: this.user.zipcode,
                prefecture: this.user.prefecture,
                city: this.user.city,
                address_1: this.user.address_1,
                building: this.user.building,
                phone: this.user.phone,
                delivery_time: this.deliveryTime
                
            })
        }
    }       
}
</script>

<style>
.jp-font-400{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  letter-spacing: 0.03em;
}

.mb48{
    margin-bottom: 48px;
}

</style>