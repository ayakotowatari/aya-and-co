<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogUnsubscribe" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title primary--text">メール配信の停止</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        <p>
                            メール配信を停止すると、商品やご利用いただけるクーポンのご案内は送られなくなりますが、aya & co.の運営上、会員の皆様に必要な情報をお送りすることがありますので、何卒ご了承ください。
                        </p>
                        <p>
                            メール配信を停止しますか？
                        </p>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="unsubscribe">停止する</v-btn>
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
        dialogUnsubscribe: Boolean,
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
            'unsubscribeEmails',
        ]),
        unsubscribe(){
            
            this.unsubscribeEmails()
            
        },
        back(){
            this.$store.commit('setDialogUnsubscribe', false);
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