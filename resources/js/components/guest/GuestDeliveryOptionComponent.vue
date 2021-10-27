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
                            <!-- <div class="jp-font grey--text text--darken-2 mb24">ご用途に応じた配送方法の選び方については、<router-link to="/postage">こちら</router-link>でご案内しております。</div> -->

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
                    </div>
                    <v-divider class="mt-4 mb-8"></v-divider>
                   
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
            'setGuestDeliveryOption',
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

                let delivery_time = this.deliveryTime

                this.setGuestDeliveryOption({
                    delivery_time: delivery_time
                })

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