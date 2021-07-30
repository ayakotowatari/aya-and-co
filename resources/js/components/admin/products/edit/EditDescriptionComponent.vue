<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="description"
                counter
                label="説明文"
                outlined
                rows="3"
                :rules="textareaRules"
                :error="allerror.description ? true : false"
                :error-messages="allerror.description"
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
            description: "",
            textareaRules: [v => v.length <= 100 || 'Max 100 characters'],
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'allerror',
        ])
    
    },
    methods: {
        ...mapActions('admin', [
            'editDescription'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.editDescription({
                    id: this.category.id,
                    description: this.description
                })
            }
        }
      

        
    }


}
</script>

<style>

</style>