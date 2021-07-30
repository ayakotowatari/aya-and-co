<template>
    <v-container>
        <v-row justify="center">
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
        </v-row>
        <v-row justify="center">
            <v-col>
                <p>お届け先のご住所</p>
                <p>〒{{deliveryAddress.zipcode}}</p>
                <p>{{deliveryAddress.prefecture}}</p>
                <p>{{deliveryAddress.city}} {{deliveryAddress.address_1}}</p>
                <p>{{deliveryAddress.building}}</p>
                <p>{{deliveryAddress.name}}様</p>
                <p>お電話番号: {{deliveryAddress.phone}}</p>
                <p>ご希望の配達時間帯: {{deliveryAddress.delivery_time}}</p>
            </v-col>
            <!-- <v-col v-if='user !== null && deliveryAddress !== null'>
                <p>お届け先のご住所</p>
                <p>〒{{deliveryAddress.zipcode}}</p>
                <p>{{deliveryAddress.prefecture}}</p>
                <p>{{deliveryAddress.city}} {{deliveryAddress.address_1}}</p>
                <p>{{deliveryAddress.building}}</p>
                <p>{{deliveryAddress.name}}様</p>
                <p>お届け先のお電話番号: {{deliveryAddress.phone}}</p>
                <p>配達時間帯: {{deliveryAddress.delivery_time}}</p>
            </v-col> -->
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="2">
                <v-btn
                    @click="$router.push({name: 'guest-checkout'})"
                >
                レジへ進む
                </v-btn>
            </v-col>
            <!-- <v-col cols="12" sm="12" md="2">
                <v-btn
                    @click="backToHome"
                >お買い物を続ける</v-btn>
            </v-col> -->
        </v-row>
    </v-container>
</template>

<script>
import { mapState } from 'vuex';

export default {
    components: {

    },
    props: {
        user: Object
    },
    data: function(){
    return{
           
        }
    
    },
    created(){

    },
    computed: {
        ...mapState([
            'cart',
            'guest',
            'deliveryAddress',
        ]),
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
    },
    methods: {
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
    },
}
</script>

<style>

</style>