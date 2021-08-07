<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="ingredients"
                counter
                label="原材料"
                outlined
                rows="3"
                :rules="textareaRules"
                :error="allerror.ingredients ? true : false"
                :error-messages="allerror.ingredients"
            >
            </v-textarea>
            <v-btn
                color="primary"
                outlined
                @click="save"
            >
                保存する
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
            ingredients: "",
            textareaRules: [v => v.length <= 200 || 'Max 200 characters'],
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
            'editIngredients'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.editIngredients({
                    id: this.category.id,
                    ingredients: this.ingredients
                })
            }
        }
      

        
    }


}
</script>

<style>

</style>