<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="updateGNote"
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
                @click="saveUpdateGuestNote"
                class="mr-2"
            >
                保存する
            </v-btn>
            <v-btn
                color="primary"
                outlined
                @click="backUpdateGuestNote"
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
        updateGuestNote: Boolean,
        order: Object
    },
    data: function(){
        return {
            valid: true,
            updateGNote: "",
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
            'updateGuestOrderNote'
        ]),
        saveUpdateGuestNote(){
            if(this.$refs.form.validate()){
                this.updateGuestOrderNote({
                    id: this.order.id,
                    note: this.updateGNote
                })
            }
        },
        backUpdateGuestNote(){
            this.$store.commit('admin/setUpdateGuestNote', false)
        }
      

        
    }


}
</script>

<style>

</style>