<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="name"
                    label="お名前" 
                    outlined
                    required
                    :rules="nameRules"
                    :error="allerror.name ? true : false"
                    :error-messages="allerror.name"
                >
                </v-text-field>
                <v-text-field
                    v-model="kana"
                    label="フリガナ" 
                    outlined
                    required
                    :rules="nameRules"
                    :error="allerror.name ? true : false"
                    :error-messages="allerror.name"
                >
                </v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateName"
                >
                    更新する
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="back"
                >
                    戻る
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
  
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        user: Object,
        isEditingName: Boolean,
    },
    data: function(){
        return {
            valid: true,
            nameRules: [
                v => !!v || '名前の入力が必要です。',
            ],
            kanaRules: [
                v => !!v || 'フリガナの入力が必要です。',
            ],
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'allerror',
        ]),
        name: {
            get(){                
                return this.user.name
            },
            set (value) {
                this.$store.commit('updateUserName', value)
            }
        },
        kana: {
            get(){                
                return this.user.kana
            },
            set (value) {
                this.$store.commit('updateUserKana', value)
            }
        },
    },
    methods: {
        ...mapActions([
            'updateUserName'
        ]),
        updateName(){

            if(this.$refs.form.validate()){
                this.updateUserName({
                    name: this.name,
                    kana: this.kana,
                })
            }
    
        },
        back(){
            this.$store.commit('setIsEditingName', false)
            this.$store.dispatch('fetchUser');
        },
      

        
    }


}
</script>

<style>

</style>