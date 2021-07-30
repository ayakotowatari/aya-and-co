<template>
    <div class="pt-6">
        <!-- <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Order
                  </div>
                  <div class="page-subtitle text--lighten-5">
                    ご購入の手続き
                  </div>
              </div>
          </v-col>
      </v-row> -->
        <registertoorderdialog-component
            v-bind:dialogRegisterToOrder="dialogRegisterToOrder"
        ></registertoorderdialog-component>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div class="form-title grey--text text--darken-4">配送先の住所を確認・指定する</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div class="jp-font grey--text text--darken-2">会員としてログインする</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4" class="mb-6">
                <logintoorder-component></logintoorder-component>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div class="jp-font grey--text text--darken-2">ゲストとして注文する</div>
            </v-col>
        </v-row>
        <v-row justify="center">
                    <v-col cols="12" sm="12" md="4">
                        <v-tabs v-model="tab" class="mb-12">
                            <v-tab
                                href="#tab-1"
                            >
                                ご自宅に送る
                            </v-tab>
                            <v-tab
                                href="#tab-2"
                            >
                                他の住所に送る
                            </v-tab>
                            <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
                        </v-tabs>

                        <v-tabs-items v-model="tab">
                            <v-tab-item 
                                value="tab-1"
                            >
                                <guesthomeaddress-component></guesthomeaddress-component>
                            </v-tab-item>
                            <v-tab-item
                                value="tab-2"
                            >
                                <guestotheraddress-component></guestotheraddress-component>
                            </v-tab-item>
                        </v-tabs-items>
                    </v-col>
                </v-row>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import Login from '../LoginComponent'

export default {
    components: {
        Login,
    },
    props: {
        user: Object
    },
    data: function(){
        return {
            tab: null,
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
    computed: {
        ...mapState([
            'dialogRegisterToOrder'
        ])
    },
    methods: {
        
    }

}
</script>

<style>
.form-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 500;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
}

</style>