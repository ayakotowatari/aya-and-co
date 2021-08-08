<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogDeliveredDate" 
                persistent
                max-width="320"
            >
                <v-card>
                    <v-container>
                        <v-row justify="center">
                            <v-col cols="12" md="12" sm="12">
                                <v-form>
                                    <v-date-picker
                                        v-model="deliveredDate"
                                        color = "primary"
                                    ></v-date-picker>
                                    <v-btn 
                                        outlined
                                        @click="input"
                                    >
                                        設定する
                                    </v-btn>
                                    <v-btn 
                                        outlined
                                        @click="close"
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
        dialogDeliveredDate: Boolean,
        order: Object
    },
    data: function(){
        return {
            deliveredDate: ""
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
            'inputDeliveredDate'
        ]),
        input(){
            this.inputDeliveredDate({
                id: this.order.id,
                delivered_date: this.deliveredDate,
            })
        },
        close(){
            this.$store.commit('admin/dialogDeliveredDate', false)
        }
        
    }


}
</script>

<style>


</style>