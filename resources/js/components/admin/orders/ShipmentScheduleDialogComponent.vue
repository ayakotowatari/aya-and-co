<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogShipment" 
                persistent
                max-width="320"
            >
                <v-card>
                    <v-container>
                        <v-row justify="center">
                            <v-col cols="12" md="12" sm="12">
                                <v-form>
                                    <v-date-picker
                                        v-model="shipmentDate"
                                        color = "primary"
                                    ></v-date-picker>
                                    <v-btn 
                                        outlined
                                        @click="schedule"
                                    >
                                        設定する
                                    </v-btn>
                                    <v-btn 
                                        outlined
                                        @click="this.$store.commit('admin/dialogShipment', false)"
                                    >
                                        戻る
                                    </v-btn>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            
        </v-dialog>
    </v-row>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialogShipment: Boolean,
        order: Object
    },
    data: function(){
        return {
            shipmentDate: ""
        }
    },
    watch: {
       
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
         ...mapState('admin', [
            'allerror',
        ]),
    },
    methods: {
        ...mapActions('admin', [
            'scheduleShipment'
        ]),
        schedule(){
            this.scheduleShipment({
                id: this.order.id,
                date: this.shipmentDate,
                delivery_time: this.order.delivery_time,
                postage: this.order.postage
            })
        }
        
    }


}
</script>

<style>


</style>