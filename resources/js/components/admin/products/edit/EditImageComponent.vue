<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
             <v-file-input 
                v-model="image"
                accept="image/*" 
                label="画像"
                outlined
                placeholder="画像を選択する"
                :rules="imageRules"
                :error="allerror.image ? true : false"
                :error-messages="allerror.image">
            </v-file-input>
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
            image: {},
            imageRules: [
                v => !v || v.size < 3000000 || '画像のサイズは3 MBまでです。',
            ],
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
            'editImage'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.editImage({
                    id: this.category.id,
                    image: this.image
                })
            }
        }
      

        
    }


}
</script>

<style>

</style>