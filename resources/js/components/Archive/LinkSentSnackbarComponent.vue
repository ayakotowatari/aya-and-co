<template>
    <v-snackbar
        v-model="linkSentSnackbar"
        :vertical="vertical"
        :timeout = "timeout"
        >
        登録されたメールアドレスに、パスワードをリセットするためのリンクが送られました。

        <template v-slot:action="{ attrs }">
            <v-btn
                text
                v-bind="attrs"
                @click="$router.push({name: 'login'})"
            >
            ログインする
            </v-btn>
            <!-- <v-btn
            text
            v-bind="attrs"
            @click="$store.commit('setLinkSentSnackbar', false)"
            >
            閉じる
            </v-btn> -->
        </template>
    </v-snackbar>
</template>
<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
       linkSentSnackbar: Boolean
    },
    data: function(){
        return {
            vertical: true,
            timeout: -1,
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
      

        
    }


}
</script>

<style>

</style>