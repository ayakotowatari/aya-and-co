<template>
    <div class="pt-6">
        <editaddressdialog-component
            v-bind:dialogEditAddress="dialogEditAddress"
        ></editaddressdialog-component>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <h4 class="jp-font grey--text text--darken-3">Step 1: ご自宅住所を確認する</h4>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="12">
                 <v-card
                    class="mb24"
                    max-width="560"
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
           
                <div class="link">
                    <v-btn 
                        outlined
                        color="primary"
                        class="mb-10"
                        @click="edit"
                        :disabled="disabled"
                    >
                        編集する
                    </v-btn>
                </div>
            </v-col>
        </v-row>
               
        <v-row justify="center">
            <v-col cols="12" sm="12" md="12">
                 <v-form 
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <h4 class="jp-font grey--text text--darken-3 mb24">Step 2: ご希望の配達時間を指定する</h4>
                    <v-select
                        v-model="deliveryTime"
                        :items = "items"
                        label="ご希望の配達時間帯"
                        outlined
                        required
                        :rules="deliveryTimeRules" 
                        :error="allerror.delivery_time"
                        :error-messages="allerror.delivery_time"
                    ></v-select>

                    <v-divider class="mt-4 mb-8"></v-divider>

                    <div class="jp-font grey--text text--darken-3 mb24">Step 3: カードメッセージを選べるサービス（無料）をご利用になられますか？</div>
                    <div class="jp-font grey--text text--darken-2 mb24">ご利用でない場合は、aya & co.よりThank Youカードを同封させていただきます。</div>
                    <!-- <v-btn
                    color="primary"
                    outlined
                    @click="$store.commit('setSelectCard', true)"
                    class="mb24 mr-2"
                    >
                    利用する
                    </v-btn> -->
                    <!-- <v-btn
                    color="grey darken-2"
                    outlined
                    @click="$store.commit('disableSelectCard', true)"
                    class="mb24"
                    >
                    利用しない
                    </v-btn> -->
                    <v-select
                        v-model="deliveryCardUse"
                        outlined
                        :items = "useCard"
                        label="カードメッセージの利用"
                        required
                        class="mb24"
                        :rules="deliveryCardUseRules" 
                        :error="allerror.delivery_carduse"
                        :error-messages="allerror.delivery_carduse"
                    ></v-select>
                    <div v-if="this.deliveryCardUse === '利用する'">
                        <div class="jp-font grey--text text--darken-3 mb24">カードのメッセージを選択してください。</div>
                            <v-select
                                v-model="deliveryCardMessage"
                                outlined
                                :items = "cards"
                                label="メッセージを選択する"
                                required
                                class="mb48"
                            ></v-select>
                    </div>
                    <v-btn
                        color="primary"
                        block
                        @click="confirm"
                        :disabled="disabled"
                        class="mb-6"
                    >
                    確定する
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
               
    </div>
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
            deliveryTime: '',
            deliveryTimeRules: [
                v => !!v || 'ご希望の配達時間を選択してください。',
            ],
            items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
            useCard: ['利用する', '利用しない'],
            cards: ["Happy Birthday", "Take Care", "Get Well Soon", "With Love"],
            deliveryCardUse: '',
            deliveryCardUseRules: [
                v => !!v || 'カードメッセージのご利用の有無を選択してください。',
            ],
            deliveryCardMessage: '',
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
            'disabled',
            'dialogEditAddress',
        ]),
    },
    methods: {
        ...mapActions([
            'setDeliveryAddress',
            'setPostage',
        ]),
        scrollToTop(){
          window.scrollTo(0,0);
        },
        edit(){

            this.$store.dispatch('dialogEditAddress', true);
                
        },
        confirm(){

            if(this.$refs.form.validate()){

                this.$store.dispatch('setPostage');

                if(this.deliveryCardUse == '利用しない'){
                    this.setDeliveryAddress({
                        name: this.user.name,
                        kana: this.user.kana,
                        zipcode: this.user.zipcode,
                        prefecture: this.user.prefecture,
                        city: this.user.city,
                        address_1: this.user.address_1,
                        building: this.user.building,
                        phone: this.user.phone,
                        delivery_time: this.deliveryTime,
                        delivery_carduse: this.deliveryCardUse,
                        delivery_cardmessage: '',
                        delivery_cardname: '',
                    })
                }else{
                    this.setDeliveryAddress({
                        name: this.user.name,
                        kana: this.user.kana,
                        zipcode: this.user.zipcode,
                        prefecture: this.user.prefecture,
                        city: this.user.city,
                        address_1: this.user.address_1,
                        building: this.user.building,
                        phone: this.user.phone,
                        delivery_time: this.deliveryTime,
                        delivery_carduse: this.deliveryCardUse,
                        delivery_cardmessage: this.deliveryCardMessage,
                        delivery_cardname: 'aya & co.',
                    })
                }

                
            }
        }
    }       
}
</script>

<style>
.jp-font-400{
  font-family: 'Noto Sans JP', sans-serif;
  letter-spacing: 0.03em;
}

.mb48{
    margin-bottom: 48px;
}

</style>