<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="320">
                <v-card>
                    <v-card-title class="headline">
                        <p>{{guest.name}}さま</p>
                    </v-card-title>
                    <v-card-text class="headline">
                        <p>ご注文をお受付けいたしました。</p>
                        <p>誠にありがとうございます。</p>
                        <p>会員としてご登録いただけますと、次回以降のお買い物がスムーズになりますので、ぜひご検討ください。</p>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="info" text @click="toRegister">会員登録をする</v-btn>
                    <v-btn color="grey darken-1" text @click="backHome">トップページに戻る</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialog: Boolean,
        guest: Object,
    },
    data: function(){
        return {
            
        }
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
        ...mapState([
          
        ])
    },
    methods: {
        toRegister(){
            this.$router.push({name: 'guest-register'});
        },
        backHome(){
            this.$router.push({name: 'home'})
        }
        
    }


}
</script>

<style>

</style>