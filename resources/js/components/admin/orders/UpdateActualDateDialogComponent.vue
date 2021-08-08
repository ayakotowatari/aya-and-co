<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogUpdateActualDate" 
                persistent
                max-width="320"
            >
                <v-card>
                    <v-container>
                        <v-row justify="center">
                            <v-col cols="12" md="12" sm="12">
                                <v-form>
                                    <v-date-picker
                                        v-model="updatedActualDate"
                                        color = "primary"
                                    ></v-date-picker>
                                    <v-btn 
                                        outlined
                                        @click="update"
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
        dialogUpdateActualDate: Boolean,
        order: Object
    },
    data: function(){
        return {
            updatedActualDate: ""
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
            'updateActualDate'
        ]),
        update(){
            this.updateActualDate({
                id: this.order.id,
                updatedActualDate: this.updatedActualDate,
            })
        },
        back(){
            this.$store.commit('admin/dialogUpdateActualDate', false)
        },
    }


}
</script>

<style>


</style>