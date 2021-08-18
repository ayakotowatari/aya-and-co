<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="updateNote"
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
                @click="saveUpdateNote"
                class="mr-2"
            >
                保存する
            </v-btn>
            <v-btn
                color="primary"
                outlined
                @click="backUpdateNote"
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
        updateOrderNote: Boolean,
        order: Object
    },
    data: function(){
        return {
            valid: true,
            updateNote: "",
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
            'updateUserOrderNote'
        ]),
        saveUpdateNote(){
            if(this.$refs.form.validate()){
                this.updateUserOrderNote({
                    id: this.order.id,
                    note: this.updateNote
                })
            }
        },
        backUpdateNote(){
            this.$store.commit('admin/setUpdateOrderNote', false)
        }
      

        
    }


}
</script>

<style>

</style>