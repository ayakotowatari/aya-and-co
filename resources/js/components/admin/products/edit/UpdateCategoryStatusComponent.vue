<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-select
                v-model="updatedStatus"
                label = "ステータス"
                :items="categoryStatuses"
                item-text="status"
                item-value="id"
            >
            </v-select>
            <v-btn 
                outlined
                @click="update"
                class="mb-2"
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
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: {
        category: Object
    },
    data: function(){
        return {
            valid: true,
            updatedStatus: "",
        }
    },
    mounted(){

        this.$store.dispatch('admin/fetchCategoryStatuses');
      
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'allerror',
            'categoryStatuses'
        ])
    
    },
    methods: {
        ...mapActions('admin', [
            'updateCategoryStatus'
        ]),
        update(){
            if(this.$refs.form.validate()){
                this.updateCategoryStatus({
                    id: this.category.id,
                    status_id: this.updatedStatus
                })
            }
        },
        back(){
            this.$store.commit('admin/setShowUpdateCategoryStatus', false)
        }
      

        
    }


}
</script>

<style>

</style>