<template>
    <div class="pt-6">
        <editaddressdialog-component
            v-bind:dialogEditAddress="dialogEditAddress"
        ></editaddressdialog-component>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <h4 class="jp-font grey--text text--darken-3">ご自宅住所を確認する</h4>
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
                <v-btn
                    color="primary"
                    block
                    @click="confirmHomeAddress"
                    :disabled="disabled.homeAddress"
                    class="mb24"
                >
                    この住所へ送る
                </v-btn>
                <v-btn 
                    outlined
                    color="primary"
                    class="mb-8"
                    @click="edit"
                    :disabled="disabled.editHomeAddress"
                >
                    編集する
                </v-btn>
               
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
            'deliveryAddress',
            'user',
            'disabled',
            'dialogEditAddress',
        ]),
    },
    methods: {
        ...mapActions([
            'confirmHomeAsDeliveryAddress',
        ]),
        scrollToTop(){
          window.scrollTo(0,0);
        },
        confirmHomeAddress(){
            this.confirmHomeAsDeliveryAddress({
                name: this.user.name,
                kana: this.user.kana,
                zipcode: this.user.zipcode,
                prefecture: this.user.prefecture,
                city: this.user.city,
                address_1: this.user.address_1,
                building: this.user.building,
                phone: this.user.phone,
                home_address: true
            })
        },
        edit(){

            this.$store.dispatch('dialogEditAddress', true);
                
        },
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