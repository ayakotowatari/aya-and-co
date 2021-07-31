<template>
    <nav>
        <v-app-bar
            flat app color="white"
        >
            <v-toolbar-title>
                <v-img
                    max-width=120
                    src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg"
                ></v-img>
            </v-toolbar-title>
            <!-- <v-spacer></v-spacer>
            <v-btn 
                text 
                @click.stop="toRegister"
            >
                <span>管理者登録</span>
            </v-btn> -->
        </v-app-bar>
    </nav>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        
    },
    data: () => ({
       
    }),
    mounted() {
        
    },
    computed: {
        
    },
    methods: {
        toRegister(){
            window.location = "/admin/register"
        },
        // toContact(){
        //     window.location = "/institution/contact";
        // }
        
    }
}
</script>