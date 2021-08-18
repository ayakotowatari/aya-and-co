<template>
    <v-container>
        <newaddressdialog-component
            v-bind:dialogNewAddress="dialogNewAddress"
        ></newaddressdialog-component>
        <removeaddressdialog-component
            v-bind:dialogRemoveAddress="dialogRemoveAddress"
            v-bind:address="address"
        ></removeaddressdialog-component>
        <div v-if="otherAddresses.length >= 1">
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <h4 class="jp-font grey--text text--darken-3 mb24">Step 1: 配送先の住所を選択する</h4>
                    <div class="jp-font-400 grey--text text--darken-2 mb24">住所をクリックして選択してください。</div>
                    <v-item-group v-model="addressGroup" mandatory>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-item v-slot="{active, toggle}" v-for="address in otherAddresses" :key="address.id" :value='address'>
                                    <v-card
                                        :elevation = "active ? '8' : ''"
                                        class="mx-auto mb-6"
                                        outlined
                                        @click="toggle"
                                        max-width=560
                                    >   
                                        <v-row align="center">
                                        <v-col cols="9" sm="9" md="9">
                                            <v-list-item three-line>
                                            <v-list-item-content>
                                                <div>
                                                    {{address.prefecture}}{{address.city}}{{address.address_1}}
                                                </div>
                                                <div v-if="address.building !== null">
                                                    {{address.building}}
                                                </div>
                                                <div>
                                                    {{address.name}}様
                                                </div>
                                            </v-list-item-content>
                                            </v-list-item>
                                        </v-col>

                                        <v-col cols="12" sm="12" md="3">
                                        <v-card-actions>
                                            <v-btn
                                                rounded
                                                outlined
                                                color="grey"
                                                @click.stop="remove(address)"
                                            >
                                                削除する
                                            </v-btn>
                                        </v-card-actions>
                                        </v-col>
                                        </v-row>
                                    </v-card>
                                </v-item>
                            </v-col>
                        </v-row>
                    </v-item-group>
                    <!-- <v-form v-if="otherAddresses !== null">
                        <v-radio-group v-model="radioGroup">
                            <template v-slot:label>
                                <div>登録されたご自宅以外の住所</div>
                            </template>
                            <v-radio
                                v-for="address in otherAddresses" :key="address.id"
                                :label="`${address.prefecture} ${address.city} ${address.address_1} ${address.name}様`"
                                :value="address" 
                                class="jp-font grey--text text--darken-4 mb-3"
                            ></v-radio>
                        </v-radio-group>
                        <v-btn
                            block
                            @click="select"
                        >
                            この住所に送る   
                        </v-btn>
                    </v-form> -->
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="jp-font-400 grey--text text--darken-2 mb24">まだ登録されていない住所を追加しますか？</div>
                    <v-btn
                        color="primary"
                        outlined
        
                        @click="newAddress"
                    >
                        新しい住所を追加する
                    </v-btn>
                </v-col>
            </v-row>
            <v-divider class="my-8"></v-divider>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <v-form>
                        <div class="jp-font grey--text text--darken-3 mb24">Step 2: ご希望の配達時間を指定する</div>
                        <v-select
                            v-model="deliveryTime"
                            outlined
                            :items = "items"
                            label="ご希望の配達時間帯"
                            required
                            class="mb24"
                        ></v-select>

                         <v-divider class="mt-4 mb-8"></v-divider>

                         <div class="jp-font grey--text text--darken-3 mb24">Step 3: ギフトカード（無料サービス）をご利用ですか？</div>
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
                            label="ギフトカードの利用"
                            required
                            class="mb24"
                         ></v-select>
                         <div v-if="this.deliveryCardUse === '利用する'">
                            <div class="jp-font grey--text text--darken-3 mb24">ギフトカードのメッセージを選択してください。</div>
                            <v-select
                                v-model="deliveryCardMessage"
                                outlined
                                :items = "cards"
                                label="メッセージを選択する"
                                required
                                class="mb48"
                            ></v-select>
                            <div class="jp-font grey--text text--darken-3 mb24">カードの差出人として、あなたのお名前をどのように表記しますか？</div>
                            <v-select
                                v-model="deliveryCardName"
                                outlined
                                :items = "displayName"
                                label="表記を選択"
                                required
                                class="mb48"
                            ></v-select>
                            <div class="jp-font grey--text text--darken-3 mb24">ギフトカード作成にあたってのご留意事項</div>
                                <div class="jp-font grey--text text--darken-2 mb24">
                                    <p>ギフトカードの差出人のお名前は、英字で表記されます。</p>
                                    <p>例1：　Hanako Shirai（姓・名両方表記の場合）</p>
                                    <p>例2：　Hanako（下のお名前のみの場合）</p>
                                    <p>お客様のお名前の読み方（フリガナ）は下記で登録されています。</p>
                                    <p>{{user.kana}}　様</p>
                                    <p>万一、フリガナに誤りがある場合は、メニューの「アカウント情報の編集」にて、修正を行なってから、ギフトカードをご注文ください。</p>
                                </div>
                        </div>  
                        <v-btn
                            color="primary"
                            block
                            @click="select"
                            :disabled="disabled"
                        >
                            確定する   
                        </v-btn>
                    </v-form>
                </v-col>
            </v-row>
        </div>
        <div v-if="otherAddresses.length <= 0">
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <p>ご自宅以外の住所はまだ登録されていません。</p>
                </v-col>
            </v-row>
            <v-row>
            <v-col cols="12" sm="12" md="12">
                <v-btn
                    color="primary"
                    outlined
    
                    @click="newAddress"
                >
                    新しい住所を追加する
                </v-btn>
            </v-col>
            </v-row>
        </div>
    </v-container>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex';

export default {
    props: {
        
    },
    data: function(){
        return {
            addressGroup: null,
            deliveryTime: '',
            deliveryCardMessage: '',
            deliveryCardName: '',
            items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
            cards: ["Thank You", "Happy Birthday", "Take Care", "Get Well Soon", "With Love"],
            displayName: ['姓・名両方', '下のお名前のみ'],
            address: {},
            deliveryCardUse: '',
            useCard: ['利用する', '利用しない']
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
        this.$store.dispatch('fetchOtherAddresses');
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'user',
            'allerror',
            'otherAddresses',
            'dialogNewAddress',
            'dialogRemoveAddress',
            'disabled',
            // 'selectCard',
        ])
    
    },
    methods: {
        ...mapActions([
            'selectAddress',
        ]),
        // ...mapMutations({
        //     select: 'selectAddress',
        // }),
        // select(){
        //     this.selectAddress({
        //         address: this.radioGroup
        //     })
        // },
        remove(value){

            this.address = value;

            this.$store.dispatch('dialogRemoveAddress', true)

        },
        // select(){
        //     this.selectAddress({
        //         address: this.addressGroup,
        //         delivery_time: this.deliveryTime,
        //         delivery_cardmessage: this.deliveryCardMessage,
        //         delivery_cardname: this.deliveryCardName,
        //         delivery_carduse: this.deliveryCardUse
        //     })
        // },
        select(){

            if(this.deliveryCardUse == '利用しない'){
                this.selectAddress({
                    address: this.addressGroup,
                    delivery_time: this.deliveryTime,
                    delivery_cardmessage: '',
                    delivery_cardname: '',
                    delivery_carduse: this.deliveryCardUse
                })
            }else{
                this.selectAddress({
                    address: this.addressGroup,
                    delivery_time: this.deliveryTime,
                    delivery_cardmessage: this.deliveryCardMessage,
                    delivery_cardname: this.deliveryCardName,
                    delivery_carduse: this.deliveryCardUse
                })
            }
            
        },
        newAddress(){
            this.$store.dispatch('dialogNewAddress', true);
        },
        // select(value){
        //     console.log(value);

        //     this.selectAddress({
        //         id: value
        //     })
        // }
    }       
}
</script>

<style>

</style>