<template>
    <v-container>
        <v-row>
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
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <v-row justify="start">
                    <v-col cols="12" sm="12" md="12">
                        <div class="form-title grey--text text--darken-4">新しいお届け先を追加する</div>
                    </v-col>
                </v-row>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <v-row>
                <v-col cols="12" sm="12" md="8">
                    <v-form>
                        <v-text-field
                            v-model="name"
                            :counter="10"
                            label="お名前"
                            outlined
                            required
                            class="text-title"
                        ></v-text-field>
                        <v-text-field
                            v-model="kana"
                            :counter="10"
                            label="フリガナ"
                            outlined
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="zipcode"
                            label="郵便番号"
                            outlined
                            required
                            hint="ハイフンなしでご記入ください。例: 1234567"
                            persistent-hint
                            :error="allerror.zipcode"
                            :error-messages="allerror.zipcode"
                        ></v-text-field>
                        <v-text-field
                            v-model="state"
                            label="都道府県"
                            outlined
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="city"
                            label="市町村"
                            outlined
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="address1"
                            label="番地・部屋番号"
                            outlined
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="building"
                            label="マンション・建物名"
                            outlined
                        ></v-text-field>
                        <v-text-field
                            v-model="phone"
                            label="電話番号"
                            outlined
                            required
                        ></v-text-field>
                        <v-select
                            v-model="deliveryTime"
                            :items = "items"
                            label="ご希望の配達時間帯"
                            outlined
                            required
                        ></v-select>
                        <v-btn
                            color="primary"
                            dark
                            block
                            @click="add"
                        >
                        追加して次へすすむ
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
        
    },
    data: function(){
        
        return {
            name: '',
            kana: '',
            zipcode: '',
            state: '',
            city: '',
            address1: '',
            building: '',
            phone: '',
            deliveryTime: '',
            items: ["希望なし", "9:00-12:00", "12:00-14:00", "14:00-16:00"],
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
        ])
    
    },
    methods: {
        ...mapActions([
            'addOtherAddress',
        ]),
        add(){
            this.addOtherAddress({
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