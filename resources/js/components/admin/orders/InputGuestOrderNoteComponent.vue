<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="inputGNote"
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
                @click="saveGuestNote"
                class="mr-2"
            >
                保存する
            </v-btn>
            <v-btn
                color="primary"
                outlined
                @click="backGuestNote"
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
        inputGuestNote: Boolean,
        order: Object
    },
    data: function(){
        return {
            valid: true,
            inputGNote: "",
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
            'inputGuestOrderNote'
        ]),
        saveGuestNote(){
            if(this.$refs.form.validate()){
                this.inputGuestOrderNote({
                    id: this.order.id,
                    note: this.inputGNote
                })
            }
        },
        backGuestNote(){
            this.$store.commit('admin/setInputGuestNote', false)
        }
      

        
    }


}
</script>

<style>

</style>