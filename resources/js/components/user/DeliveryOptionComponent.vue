<template>
    <div class="pt-6">
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div class="form-title grey--text text--darken-4">配送オプションを選択する</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                 <v-form 
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <div class="mb-8">
                        <div v-if="totalQuantityInCart >= 4">
                            <div class="jp-font grey--text text--darken-3 mb24">Step 1: ご希望の配送方法をお選びください。</div>
                            <!-- <div class="jp-font grey--text text--darken-2 mb24">ご用途に応じた配送方法の選び方については、<router-link to="/postage">こちら</router-link>でご案内しております。</div> -->

                            <v-select
                                v-model="courier"
                                outlined
                                :items = "courierMiddle"
                                item-text="courier_type"
                                item-value="id"
                                label="配送方法を選ぶ"
                                required
                                :rules="courierRules" 
                                :error="allerror.couriers ? true : false"
                                :error-messages="allerror.couriers"
                            ></v-select>
                        </div>
                        <div v-else class="mb-8">
                            <div class="jp-font grey--text text--darken-3 mb24">Step 1: ご希望の配送方法をお選びください。</div>
                            <div class="jp-font grey--text text--darken-2 mb24">ご用途に応じた配送方法の選び方については、<router-link to="/postage">こちら</router-link>でご案内しております。</div>

                            <v-select
                                v-model="courier"
                                outlined
                                :items = "courierStandard"
                                item-text="courier_type"
                                item-value="id"
                                label="配送方法を選ぶ"
                                required
                                :rules="courierRules" 
                                :error="allerror.couriers ? true : false"
                                :error-messages="allerror.couriers"
                            ></v-select>
                        </div>
<!-- 
                        <div v-if="this.courier == 2 && totalQuantityInCart > 3">
                            宅急便コンパクトでの梱包数はxxとなります。
                        </div> -->

                    </div>

                    <v-divider class="mt-4 mb-8"></v-divider>
                    <div class="mb-8">
                        <div class="jp-font grey--text text--darken-3 mb24">Step 2: 選べるメッセージカードサービスのご利用について</div>
                        <div v-if="this.courier === null">
                            <div class="jp-font grey--text text--darken-2">配送方法をお選びいただくと、オプションが示されます。</div>
                        </div>
                        <div v-if="this.courier !== null">
                            <div v-if="this.courier === 3">
                                <div class="jp-font grey--text text--darken-2">お選びいただいた配送方法では、メッセージカードはご利用になられません。</div>
                            </div>
                            <div v-if="this.courier !== 3">
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
                                    <div class="jp-font grey--text text--darken-3 mb24">カードの差出人として、どちらを記載しますか？</div>
                                    <v-select
                                        v-model= "sender"
                                        outlined
                                        :items = "senders"
                                        label="差出人の名前を指定する"
                                        required
                                        class="mb48"
                                        :rules="senderRules" 
                                    ></v-select>
                                    <div v-if="this.sender === 'ご自身のお名前'">
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
                        </div>
                    </div>
                    <v-divider class="mt-4 mb-8"></v-divider>
                    <h4 class="jp-font grey--text text--darken-3 mb24">Step 3: ご希望の配達時間を指定する</h4>
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
                    <div>
                        <v-divider class="mt-4 mb-8"></v-divider>
                         <h4 class="jp-font grey--text text--darken-3 mb24">Step 4: 備考欄</h4>
                        <v-textarea
                            v-model="deliveryNote"
                            label="備考欄"
                            outlined
                            rows="6"
                            :error="allerror.message? true : false"
                            :error-messages="allerror.message"
                        ></v-textarea>
                    </div>
                    <!-- <div v-if="deliveryAddress.home_address == true && this.courier !== 3">
                        <v-divider class="mt-4 mb-8"></v-divider>
                         <h4 class="jp-font grey--text text--darken-3 mb24">Step 4: 備考欄</h4>
                        <v-textarea
                            v-model="deliveryNote"
                            label="備考欄"
                            outlined
                            rows="8"
                            :error="allerror.note ? true : false"
                            :error-messages="allerror.note"
                        ></v-textarea>
                    </div> -->
                     <!-- <div v-if="deliveryAddress.home_address == false && this.courier !== 3">
                        <v-divider class="mt-4 mb-8"></v-divider>
                         <h4 class="jp-font grey--text text--darken-3 mb24">Step 4: 備考欄</h4>
                        <v-textarea
                            v-model="deliveryNote"
                            label="備考欄"
                            outlined
                            rows="3"
                            :error="allerror.note ? true : false"
                            :error-messages="allerror.note"
                        ></v-textarea>
                    </div> -->
                    <v-btn
                        color="primary"
                        block
                        @click="confirm"
                        :disabled="disabled.confirmDeliveryOption"
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
        deliveryAddress: Object
    },
    data: function(){
        
        return {
            valid: true,
            courier: null,
            courierRules: [
                v => !!v || 'ご希望の配送方法を選択してください。',
            ],
            deliveryTime: '',
            deliveryTimeRules: [
                v => !!v || 'ご希望の配達時間を選択してください。',
            ],
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
            items: ["希望なし", "8:00-12:00", "14:00-16:00", "16:00-18:00", "18:00-20:00", "19:00-21:00"],
            useCard: ['利用する', '利用しない'],
            cards: ["Thank You", "Happy Birthday", "Take Care", "Get Well Soon", "With Love", 'Sending You a Hug'],
            deliveryCardUse: '',
            deliveryCardUseRules: [
                v => !!v || 'メッセージカードのご利用の有無を選択してください。',
            ],
            deliveryCardMessage: '',
            deliveryCardMessageRules: [
                v => !!v || 'メッセージカードを選択してください。',
            ],
            sender: null,
            senders:["ご自身のお名前", "aya & co."],
            senderRules: [
                v => !!v || '差出人を選択してください。',
            ],
            deliveryCardName: '',
            displayName: ['姓・名両方', '名（ファーストネーム）のみ'],
            deliveryCardNameRules: [
                v => !!v || 'お名前の表記方法を選択してください。',
            ],
            deliveryNote: ''
        }
    },
    mounted(){
      
    },
    created(){
        this.$store.dispatch('fetchPostages')
    },
    computed: {
        ...mapState([
            'allerror',
            'user',
            'disabled',
            'postages',
            'couriers', 
            'cart'
        ]),
        totalQuantityInCart(){
           
            let setInCart = this.cart.filter(cart => cart.set === 1);
            let setInCartQuantity = setInCart.reduce((acc,item) => acc + item.quantity, 0);

            let itemInCartQuantity = this.cart.reduce((acc,item) => acc + item.quantity, 0);

            let totalInCartQuantity = setInCartQuantity + itemInCartQuantity;
            console.log('result', totalInCartQuantity);

            return totalInCartQuantity;

        },
        courierStandard(){
            return this.couriers.filter(courier => courier.id !== 2)
        },
        courierMiddle(){
            return this.couriers.filter(courier => courier.id !== 1)
        },
        courierBig(){
            return this.couriers.filter(courier => courier.id === 2)
        },
    },
    methods: {
        ...mapActions([
            'setDeliveryOption',
            'setPostage',
        ]),
        scrollToTop(){
          window.scrollTo(0,0);
        },
        confirm(){

            if(this.$refs.form.validate()){

                // this.$store.dispatch('setPostage', this.courier);
                this.setPostage({
                    courier: this.courier,
                    prefecture: this.deliveryAddress.prefecture,
                    totalQuantity: this.totalQuantityInCart
                })

                if(this.courier == 3){
                    this.setDeliveryOption({
                        courier: this.courier,
                        delivery_time: this.deliveryTime,
                        delivery_carduse: '利用しない',
                        delivery_cardmessage: '',
                        delivery_cardname: '',
                        delivery_note: this.deliveryNote,
                    })
                }else if(this.deliveryCardUse == '利用する'){
                    if(this.sender == 'ご自身のお名前'){
                        this.setDeliveryOption({
                            courier: this.courier,
                            delivery_time: this.deliveryTime,
                            delivery_carduse: this.deliveryCardUse,
                            delivery_cardmessage: this.deliveryCardMessage,
                            delivery_cardname: this.deliveryCardName,
                            delivery_note: this.deliveryNote
                        })
                    }else{
                        this.setDeliveryOption({
                            courier: this.courier,
                            delivery_time: this.deliveryTime,
                            delivery_carduse: this.deliveryCardUse,
                            delivery_cardmessage: this.deliveryCardMessage,
                            delivery_cardname: 'aya & co.',
                            delivery_note: this.deliveryNote
                        })
                    }
                }else{
                     this.setDeliveryOption({
                        courier: this.courier,
                        delivery_time: this.deliveryTime,
                        delivery_carduse: this.deliveryCardUse,
                        delivery_cardmessage: '',
                        delivery_cardname: '',
                        delivery_note: this.deliveryNote
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