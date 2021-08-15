<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogDeleteUser" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title primary--text">アカウントの削除</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        <p>
                            アカウントを削除すると、登録された住所（ご自宅・その他）が削除され、注文履歴の閲覧ができなくなります。
                        </p>
                        <p>
                            アカウントを削除しますか？
                        </p>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toDelete">削除する</v-btn>
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
        dialogDeleteUser: Boolean,
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
            'deleteUser',
        ]),
        toDelete(){
            
            this.deleteUser({
                id: this.user.id
            })
            
        },
        back(){
            this.$store.commit('setDialogDeleteUser', false);
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