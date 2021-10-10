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
                    <div class="jp-font-400 grey--text text--darken-2 mb24">住所をクリックして選択してください。選択されると、色が赤く変わります。</div>
                    <v-item-group v-model="addressGroup" mandatory>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-item v-slot="{active, toggle}" v-for="address in otherAddresses" :key="address.id" :value='address'>
                                    <v-card
                                        elevation = "2"
                                        :color = "active ? '#F9D9D9' : '#ffffff'"
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
                                                color="grey darken-1"
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
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <div class="mb-8">
                            <div class="jp-font grey--text text--darken-3 mb24">Step 2: ご希望の配送方法をお選びください。</div>
                            <div class="jp-font grey--text text--darken-2 mb24">ご用途に応じた配送方法の選び方については、<router-link to="/postage">こちら</router-link>でご案内しております。</div>

                            <v-select
                                v-model="courier"
                                outlined
                                :items = "couriers"
                                item-text="courier_type"
                                item-value="id"
                                label="配送方法を選ぶ"
                                required
                                :rules="courierRules" 
                                :error="allerror.couriers ? true : false"
                                :error-messages="allerror.couriers"
                            ></v-select>
                        </div>

                        <v-divider class="mt-4 mb-8"></v-divider>
                        <div class="mb-8">
                            <div class="jp-font grey--text text--darken-3 mb24">Step 3: 選べるメッセージカードサービスのご利用について</div>
                            <div v-if="this.courier === null">
                                <div class="jp-font grey--text text--darken-2">配送方法をお選びいただくと、オプションが示されます。</div>
                            </div>
                            <div v-if="this.courier === 2">
                                <div class="jp-font grey--text text--darken-2">お選びいただいた配送方法では、メッセージカードはご利用になられません。</div>
                            </div>
                            <div v-if="this.courier === 1">
                                <div class="jp-font grey--text text--darken-2 mb24">選べるメッセージカードサービス（無料）をご利用になられますか？</div>
                                <div class="jp-font grey--text text--darken-2 mb24">ご利用でない場合は、aya & co.よりThank Youカードを同封させていただきます。</div>
                                <v-select
                                    v-model="deliveryCardUse"
                                    outlined
                                    :items = "useCard"
                                    label="メッセージカードの利用"
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
                                        :rules="deliveryCardMessageRules" 
                                        :error="allerror.delivery_cardmessage"
                                        :error-messages="allerror.delivery_cardmessage"
                                    ></v-select>
                                        <div class="jp-font grey--text text--darken-3 mb24">カードの差出人として、あなたのお名前をどのように表記しますか？</div>
                                            <v-select
                                            v-model="deliveryCardName"
                                            outlined
                                            :items = "displayName"
                                            label="表記を選択"
                                            required
                                            class="mb48"
                                            :rules="deliveryCardNameRules" 
                                        ></v-select>
                                        <div class="jp-font grey--text text--darken-3 mb24">ギフトカード作成にあたってのご留意事項</div>
                                            <div class="jp-font grey--text text--darken-2 mb24">
                                                <p>ギフトカードの差出人のお名前は、ご登録いただいているフリガナにもとづいて、英字で表記されます。</p>
                                                <p>例1：　Hanako Shirai（姓・名両方表記の場合）</p>
                                                <p>例2：　Hanako（下のお名前のみの場合）</p>
                                                <p>お客様のお名前のフリガナは下記で登録されています。</p>
                                                <p>{{user.kana}}　様</p>
                                                <p>万一、フリガナに誤りがある場合は、メニューの「アカウント情報の編集」にて、修正を行なってから、ギフトカードをご注文ください。</p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        
                        <v-divider class="mt-4 mb-8"></v-divider>
                        
                        <div class="jp-font grey--text text--darken-3 mb24">Step 2: ご希望の配達時間を指定する</div>
                        <v-select
                            v-model="deliveryTime"
                            outlined
                            :items = "items"
                            label="ご希望の配達時間帯"
                            required
                            class="mb24"
                            :rules="deliveryTimeRules" 
                            :error="allerror.delivery_time"
                            :error-messages="allerror.delivery_time"
                        ></v-select>
                        <v-btn
                            color="primary"
                            block
                            @click="select"
                            :disabled="disabled"
                            class="mb-4"
                        >
                            確定する   
                        </v-btn>
                        <v-btn
                            color="grey darken-2"
                            outlined
                            :disabled="!disabled"
                            @click="reset"
                        >配送先の住所を変更する</v-btn>
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
            valid: true,
            courier: null,
            courierRules: [
                v => !!v || 'ご希望の配送方法を選択してください。',
            ],
            addressGroup: null,
            deliveryTime: '',
            deliveryTimeRules: [
                v => !!v || 'ご希望の配達時間を選択してください。',
            ],
            deliveryCardMessage: '',
            deliveryCardMessageRules: [
                v => !!v || 'メッセージを選択してください。',
            ],
            deliveryCardName: '',
            deliveryCardNameRules: [
                v => !!v || 'お名前の表記方法を選択してください。',
            ],
            items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
            cards: ["Thank You", "Happy Birthday", "Take Care", "Get Well Soon", "With Love", "Sending You a Hug"],
            displayName: ['姓・名両方', '下のお名前のみ'],
            address: {},
            deliveryCardUse: '',
            deliveryCardUseRules: [
                v => !!v || 'カードメッセージのご利用の有無を選択してください。',
            ],
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
        this.$store.dispatch('fetchPostages')
    },
    computed: {
        ...mapState([
            'user',
            'allerror',
            'otherAddresses',
            'dialogNewAddress',
            'dialogRemoveAddress',
            'disabled',
            'postages',
            'couriers'
            // 'selectCard',
        ])
    
    },
    methods: {
        ...mapActions([
            'selectAddress',
            'setOtherPostage'
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

            if(this.$refs.form.validate()){

                // this.$store.dispatch('setOtherPostage', {
                //     courier: this.courier,
                //     prefecture: this.addressGroup.prefecture
                // });

                // console.log('prefecture', this.addressGroup.prefecture)
                console.log('courier', this.courier)

                if(this.courier == 2){
                    this.selectAddress({
                        address: this.addressGroup,
                        delivery_time: this.deliveryTime,
                        delivery_cardmessage: '',
                        delivery_cardname: '',
                        delivery_carduse: '利用しない'
                    })
                }else if(this.deliveryCardUse == '利用する'){
                    this.selectAddress({
                        address: this.addressGroup,
                        delivery_time: this.deliveryTime,
                        delivery_cardmessage: this.deliveryCardMessage,
                        delivery_cardname: this.deliveryCardName,
                        delivery_carduse: this.deliveryCardUse
                    })
                }else{
                     this.selectAddress({
                        address: this.addressGroup,
                        delivery_time: this.deliveryTime,
                        delivery_cardmessage: '',
                        delivery_cardname: '',
                        delivery_carduse: this.deliveryCardUse
                    })
                }

                this.setOtherPostage({
                    courier: this.courier,
                    prefecture: this.addressGroup.prefecture
                })

                // if(this.deliveryCardUse == '利用しない'){
                //     this.selectAddress({
                //         address: this.addressGroup,
                //         delivery_time: this.deliveryTime,
                //         delivery_cardmessage: '',
                //         delivery_cardname: '',
                //         delivery_carduse: this.deliveryCardUse
                //     })
                // }else{
                //     this.selectAddress({
                //         address: this.addressGroup,
                //         delivery_time: this.deliveryTime,
                //         delivery_cardmessage: this.deliveryCardMessage,
                //         delivery_cardname: this.deliveryCardName,
                //         delivery_carduse: this.deliveryCardUse
                //     })
                //  }

            }

            
            
        },
        newAddress(){
            this.$store.dispatch('dialogNewAddress', true);
        },

        reset(){
            this.$refs.form.reset();
            this.$store.commit('setDisabled', false);
            this.$store.commit('updateDisableContinue1', true);
        }
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