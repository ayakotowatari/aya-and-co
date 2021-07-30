<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogLinkSent" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title grey--text text--darken-4">パスワードリセット</div>
                    </v-card-title>
                    <v-card-text class="ja-font-400">
                        登録されたメールアドレスに、パスワードをリセットするためのリンクが送られました。
                    </v-card-text>
                    <v-card-text class="ja-font-400">
                        メールを確認し、パスワードをリセットしてください。
                    </v-card-text>
                    <v-card-text class="ja-font-400">
                        パスワードをリセットすると、自動的にログインされます。もしくは、リセット後に、下記のボタンからログインしてください。
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toLogin">ログインする</v-btn>
                    <v-btn text @click="toHome">ホームに戻る</v-btn>
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
        dialogLinkSent: Boolean,
        // guest: Object,
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
        toLogin(){
            this.$router.push({name: 'login'});
            // this.$store.commit('setDialogThankYouGuest', false);
            // this.$store.commit('updateDisableContinue1', true);
            // this.$store.commit('setDisabled', false);
        },
        // backHome(){
        //     this.$router.push({name: 'home'})
        //      this.$store.commit('setDialogThankYouGuest', false);
        //      this.$store.commit('updateDisableContinue1', true);
        //     this.$store.commit('setDisabled', false);
        // }
        toHome(){
            window.location = "/"
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