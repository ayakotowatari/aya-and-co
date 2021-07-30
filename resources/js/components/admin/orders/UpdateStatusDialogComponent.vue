<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogUpdateStatus" 
                persistent
                max-width="320"
            >
                <v-card>
                    <v-container>
                        <v-row justify="center">
                            <v-col cols="12" md="12" sm="12">
                                <v-form>
                                    <v-select
                                        v-model="updatedStatus"
                                        label = "ステータス"
                                        :items="statuses"
                                        item-text="status"
                                        item-value="id"
                                    >
                                    </v-select>
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
        dialogUpdateStatus: Boolean,
        order: Object,
    },
    data: function(){
        return {
            updatedStatus: ""
        }
    },
    watch: {
       
    },
    mounted(){
        this.$store.dispatch('admin/fetchStatuses');
    },
    created(){
       
     
    },
    computed: {
         ...mapState('admin', [
            'statuses',
            'allerror',
        ]),
    },
    methods: {
        ...mapActions('admin', [
            'updateStatus'
        ]),
        update(){
            this.updateStatus({
                id: this.order.id,
                status_id: this.updatedStatus,
            })
        },
        back(){
            this.$store.commit('admin/dialogUpdateStatus', false)
        }
        
    }


}
</script>

<style>


</style>