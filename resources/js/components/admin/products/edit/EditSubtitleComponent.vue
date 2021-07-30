<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="subtitle"
                counter
                label="サブタイトル"
                outlined
                rows="3"
                :rules="textareaRules"
                :error="allerror.subtitle ? true : false"
                :error-messages="allerror.subtitle"
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
            subtitle: "",
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
            'editSubtitle'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.editSubtitle({
                    id: this.category.id,
                    subtitle: this.subtitle
                })
            }
        }
      

        
    }


}
</script>

<style>

</style>