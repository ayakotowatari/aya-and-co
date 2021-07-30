<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogUpdateShipment" 
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
                                        class="mr-2"
                                    >
                                        更新する
                                    </v-btn>
                                    <v-btn 
                                        outlined
                                        @click="back"
                                    >
                                        もどる
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
        dialogUpdateShipment: Boolean,
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
            'updateScheduleShipment'
        ]),
        schedule(){
            this.updateScheduleShipment({
                id: this.order.id,
                date: this.shipmentDate,
            })
        },
        back(){
            this.$store.commit('admin/dialogUpdateShipment', false)
        }
        
    }


}
</script>

<style>


</style>