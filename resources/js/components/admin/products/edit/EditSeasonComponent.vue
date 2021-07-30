<template>
    <div>
        <v-form
            v-model="valid"
            ref="form"
            lazy-validation
        >
            <v-textarea
                v-model="season"
                counter
                label="シーズン"
                outlined
                rows="1"
                :rules="textareaRules"
                :error="allerror.season ? true : false"
                :error-messages="allerror.season"
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
            season: "",
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
            'editSeason'
        ]),
        save(){
            if(this.$refs.form.validate()){
                this.editSeason({
                    id: this.category.id,
                    season: this.season
                })
            }
        }
      

        
    }


}
</script>

<style>

</style>