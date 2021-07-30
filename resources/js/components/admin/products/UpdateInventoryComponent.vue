<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="inventory"
                counter
                label="在庫数"
                outlined
                rows="1"
                :rules="textareaRules"
                :error="allerror.inventory? true : false"
                :error-messages="allerror.inventory"
            >
            </v-textarea>
            <v-btn
                color="primary"
                outlined
                @click="save"
            >
                保存する
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
            inventory: "",
            textareaRules: [v => v.length <= 100 || 'Max 100 characters'],
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'allerror'
        ])
    
    },
    methods: {
        ...mapActions('admin', [
            'updateInventory'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.updateInventory({
                    id: this.product.id,
                    inventory: this.inventory
                })
            }
        },
        back(){
            this.$store.commit('admin/setShowUpdateInventory', false)
        }
      

        
    }


}
</script>

<style>

</style>