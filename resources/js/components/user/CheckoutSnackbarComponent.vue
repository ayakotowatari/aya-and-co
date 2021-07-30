<template>
    <v-snackbar
        v-model="checkoutSnackbar"
        :vertical="vertical"
        :timeout = "timeout"
        >
        {{ checkoutError }}

        <template v-slot:action="{ attrs }">
            <v-btn
            text
            v-bind="attrs"
            @click="$store.commit('setCheckoutSnackbar', false)"
            >
            閉じる
            </v-btn>
        </template>
    </v-snackbar>
</template>
<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        checkoutError: String
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
            'checkoutSnackbar'
        ])
    
    },
    methods: {
      

        
    }


}
</script>

<style>

</style>