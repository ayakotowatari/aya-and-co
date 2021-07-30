<template>
    <v-container>
         <v-row justify="center" v-if="user !== null">
            <v-col cols="12" sm="12" md="4">
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <h4>新しい配送先の追加</h4>
                        <v-form>
                            <v-text-field
                                v-model="name"
                                :counter="10"
                                label="宛名"
                                required
                                class="text-title"
                            ></v-text-field>
                            <v-text-field
                                v-model="kana"
                                :counter="10"
                                label="フリガナ"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="zipcode"
                                label="郵便番号"
                                required
                                hint="ハイフンなしでご記入ください。例: 1234567"
                                persistent-hint
                                :error="allerror.zipcode"
                                :error-messages="allerror.zipcode"
                            ></v-text-field>
                            <v-text-field
                                v-model="state"
                                label="都道府県"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="city"
                                label="市町村"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="address1"
                                label="番地・部屋番号"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="building"
                                label="マンション・建物名"
                            ></v-text-field>
                            <v-text-field
                                v-model="phone"
                                label="電話番号"
                                required
                            ></v-text-field>
                            <v-select
                                v-model="deliveryTime"
                                :items = "items"
                                label="ご希望の配達時間帯"
                                required
                            ></v-select>
                            <v-btn
                                @click="add"
                                :loading="loading"
                            >
                            この住所を追加する
                            </v-btn>
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
        user: Object
    },
    data: function(){
        
        return {
            type: '',
            name: '',
            kana: '',
            zipcode: '',
            state: '',
            city: '',
            address1: '',
            building: '',
            phone: '',
            deliveryTime: '',
            items: ["9:00-12:00", "12:00-14:00", "14:00-16:00"],
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
        ])
    
    },
    methods: {
        ...mapActions([
            'addAddress'
        ]),
        add(){
            this.addAddress({
                type: 1,
                name: this.name,
                kana: this.kana,
                zipcode: this.zipcode,
                prefecture: this.state,
                city: this.city,
                address_1: this.address1,
                building: this.building,
                phone: this.phone,
                delivery_time: this.deliveryTime
            })
        }

      
        
    }       
}
</script>

<style>

</style>