<template>
    <v-container>
        <div class="key-visual">
            <v-img
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/twomarmalades.png"
            ></v-img>
            <!-- <v-img
                max-width=100%
                max-height=100%
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/twomarmalades.png"
                class="hidden-md-and-up"
            ></v-img> -->
        </div>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Products List
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        商品ラインナップ
                    </div>
                </div>
            </v-col>
        </v-row>

        <div class="mb-10">
            <p class="description">
                <span class="logo-title">aya & co. </span>では、季節の旬の果物を仕入れて、small batch（少量生産）にて商品を製造します。ほとんどはシーズンの短期間のみの販売となりますので、気に入られた商品は、ぜひお早めにお求めください。
            </p>  
        </div>

        <v-tabs v-model="tab" class="mb-12">
          <v-tab
              href="#tab-1"
          >
              全ての商品
          </v-tab>
          <v-tab
              href="#tab-2"
          >
              いま販売中の商品
          </v-tab>
          <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
        </v-tabs>

        <v-tabs-items v-model="tab">
            <v-tab-item 
                value="tab-1"
            >
                <allproducts-component></allproducts-component>
            </v-tab-item>
            <v-tab-item
                value="tab-2"
            >
                <currentproducts-component></currentproducts-component>
            </v-tab-item>
        </v-tabs-items>
    </v-container>
</template>

<script>
export default {
    data: function(){
        return {
            tab: null,
        
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