<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Contact
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        お問い合わせ
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <!-- <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    このページは、ただいま準備中です。
                </div> -->
                <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    <a href="https://forms.gle/kSJ8nj9ennqwvvai8" target="_blank" rel="noopener noreferrer">こちらのフォーム</a>よりお問い合わせをお送りください。                
                </div>
                <div class="message grey--text text--darken-2 mb-6">
                    公式LINEアカウントからのお問い合わせもお受付けしております。以下のボタンから、「友だち追加」の上、メッセージをお送りください。
                </div>
                <div>
                <v-btn
                    href = "https://lin.ee/1RJJ9C3"
                    outlined
                    color="primary"
                >
                    LINEに友だち追加する
                </v-btn>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: function(){
        return {
            
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
    
    },
    methods: {
      

        
    }


}
</script>

<style>
a{
    text-decoration: none;
}

</style>