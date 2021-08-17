<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="inputNote"
                counter
                label="備考"
                outlined
                rows="10"
                :rules="textareaRules"
                :error="allerror.note ? true : false"
                :error-messages="allerror.note"
            >
            </v-textarea>
            <v-btn
                color="primary"
                outlined
                @click="saveNote"
                class="mr-2"
            >
                保存する
            </v-btn>
            <v-btn
                color="primary"
                outlined
                @click="backNote"
            >
                戻る
            </v-btn>
        </v-form>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: {
        inputOrderNote: Boolean,
        order: Object
    },
    data: function(){
        return {
            valid: true,
            inputNote: "",
            textareaRules: [v => v.length <= 300 || 'Max 300 characters'],
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
            'inputUserOrderNote'
        ]),
        saveNote(){
            if(this.$refs.form.validate()){
                this.inputUserOrderNote({
                    id: this.order.id,
                    note: this.inputNote
                })
            }
        },
        backNote(){
            this.$store.commit('admin/setInputOrderNote', false)
        }
      

        
    }


}
</script>

<style>

</style>