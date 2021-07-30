<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent fullscreen>
                <v-card>
                    <v-card-title class="headline">
                        <h4>{{deliveryAddress.name}}様への荷物の配送</h4>
                    </v-card-title>
                    <v-card-text class="headline">
                        <v-container>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <div class="mt-10">
                                        ご希望の配達時間帯をお選びください。
                                    </div>
                                    <v-select
                                        v-model="deliveryTime"
                                        :items = "items"
                                        label="ご希望の配達時間帯"
                                        required
                                        class="mb-10"
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="grey darken-1" text @click="confirm">注文内容を確認する</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialog: Boolean,
    },
    data: function(){
        return {
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
            'deliveryAddress'
        ])
    },
    methods: {
       confirm(){

           let delivery_time = this.deliveryTime;
           this.$store.commit('setDeliveryTime', delivery_time);
           this.$store.commit('setDialog', false);

           this.$router.push({name: "order-confirmation"})
       } 
    }


}
</script>

<style>

</style>