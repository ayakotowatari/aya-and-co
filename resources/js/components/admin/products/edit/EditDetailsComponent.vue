<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="details"
                counter
                label="詳細"
                outlined
                rows="3"
                :rules="textareaRules"
                :error="allerror.details ? true : false"
                :error-messages="allerror.details"
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
            details: "",
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
            'editDetails'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.editDetails({
                    id: this.category.id,
                    details: this.details
                })
            }
        }
      

        
    }


}
</script>

<style>

</style>