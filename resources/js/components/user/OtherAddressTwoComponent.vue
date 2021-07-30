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
                <v-item-group v-model="addressGroup" mandatory>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-item v-slot="{active, toggle}" v-for="address in otherAddresses" :key="address.id" :value='address'>
                                <v-card
                                    :elevation = "active ? '6' : ''"
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

                                    <v-col cols="3" sm="3" md="3">
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
                     <h4 class="jp-font grey--text text--darken-3 mb24">Step 2: ご希望の配達時間を指定する</h4>
                    <v-form>
                        <v-select
                            v-model="deliveryTime"
                            outlined
                            :items = "items"
                            label="ご希望の配達時間帯"
                            required
                            class="mb48"
                        ></v-select>
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
            items: ["9:00-12:00", "12:00-14:00", "14:00-16:00"],
            address: {},
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
            'allerror',
            'otherAddresses',
            'dialogNewAddress',
            'dialogRemoveAddress',
            'disabled'
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
        select(){
            this.selectAddress({
                address: this.addressGroup,
                delivery_time: this.deliveryTime
            })
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