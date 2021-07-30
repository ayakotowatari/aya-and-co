<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-select
                v-model="updatedProductStatus"
                label = "ステータス"
                :items="categoryStatuses"
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
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: {
        product: Object
    },
    data: function(){
        return {
            valid: true,
            updatedProductStatus: "",
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
            'updateProductStatus'
        ]),
        update(){
            if(this.$refs.form.validate()){
                this.updateProductStatus({
                    id: this.product.id,
                    status_id: this.updatedProductStatus
                })
            }
        },
        back(){
            this.$store.commit('admin/setShowUpdateProductStatus', false)
        }
      

        
    }


}
</script>

<style>

</style>