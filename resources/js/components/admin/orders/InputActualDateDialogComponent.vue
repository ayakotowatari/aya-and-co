<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogActualDate" 
                persistent
                max-width="320"
            >
                <v-card>
                    <v-container>
                        <v-row justify="center">
                            <v-col cols="12" md="12" sm="12">
                                <v-form>
                                    <v-date-picker
                                        v-model="actualDate"
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
        dialogActualDate: Boolean,
        order: Object
    },
    data: function(){
        return {
            actualDate: ""
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
            'inputActualDate'
        ]),
        input(){
            this.inputActualDate({
                id: this.order.id,
                actual_date: this.actualDate,
            })
        },
        close(){
            this.$store.commit('admin/dialogActualDate', false)
        }
        
    }


}
</script>

<style>


</style>