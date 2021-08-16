<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogThankYouGuest" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title grey--text text--darken-4">{{guest.name}}様</div>
                    </v-card-title>
                    <v-card-text class="ja-font-400">
                        ご注文をお受付けいたしました。
                        誠にありがとうございます。<br>
                        お届けまでしばらくお待ちくださいませ。
                    </v-card-text>
                    <v-card-text class="ja-font-400">
                        会員としてご登録いただけますと、次回以降のご注文からお買い物がスムーズになりますので、ぜひご検討ください。
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toRegister">会員登録をする</v-btn>
                    <v-btn color="grey darken-2" text @click="backHome">トップページに戻る</v-btn>
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
        dialogThankYouGuest: Boolean,
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
            this.$store.commit('setDialogThankYouGuest', false);
            this.$store.commit('updateDisableContinue1', true);
            this.$store.commit('setDisabled', false);
        },
        backHome(){
            this.$router.push({name: 'home'})
             this.$store.commit('setDialogThankYouGuest', false);
             this.$store.commit('updateDisableContinue1', true);
            this.$store.commit('setDisabled', false);
        }
        
    }


}
</script>

<style>
.dialog-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}


</style>