<template>
    <v-container>
        <div class="key-visual">
            <v-img
                max-width=1137
                max-height=636
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/kirigamine.png"
                class="hidden-sm-and-down"
            ></v-img>
            <v-img
                max-width=327
                max-height=183
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/kirigamine.png"
                class="hidden-md-and-up"
            ></v-img>
        </div>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Sustainability
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    環境に優しい包装について
                  </div>
              </div>
          </v-col>
      </v-row>
      <p class="description">
        <span class="logo">aya & co.</span> では、環境に優しい包装に取り組んでいます。
      </p>   
      <p class="description">
        このページでは、私たちが環境に対してどのようにアプローチしていくかをご紹介いたします。
      </p>   
    </v-container>
  
</template>

<script>
export default {
    data: function(){
        return {
            tab: null,
        items: [
          'web', 'shopping', 'videos', 'images', 'news',
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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

</style>