<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogSubscribe" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title primary--text">メール配信の再開</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        <p>
                            メール配信を再開すると、商品やご利用いただけるクーポンのご案内がご登録のメールアドレスまで送られます。
                        </p>
                        <p>
                            メール配信を再開しますか？
                        </p>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="subscribe">再開する</v-btn>
                    <v-btn color="grey darken-2" text @click="back">戻る</v-btn>
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
        dialogSubscribe: Boolean,
        user: Object,
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
        ...mapActions([
            'subscribeEmails',
        ]),
        subscribe(){
            
            this.subscribeEmails()
            
        },
        back(){
            this.$store.commit('setDialogSubscribe', false);
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