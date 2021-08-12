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
                max-width=360
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
      <div class="mb-10">
          <p class="description">
            aya & co. では、環境に優しい包装に取り組んでいます。
          </p>   
      </div>
      <!-- <p class="description">
        このページでは、私たちが環境に対してどのようにアプローチしていくかをご紹介いたします。現在、準備中です。
      </p>    -->
      <v-row>
          <v-col cols="12" sm="12" md="4">
              <p class="item-title">自然の緩衝材</p>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <p class="description">
                  店舗をもたず、ネットでの販売をするときに課題になるのが、包装（パッケージ）です。<br class="lg">
                  マーマレードの瓶を安全に配送するために、よく使われるのは、<br class="lg">
                  個別に包装する紙の箱や、プラスチックの緩衝材。<br class="lg">
                  これらの包装材は、環境に負荷がかかるものです。<br>
                  どうにかして、環境への負担を減らしつつ、手にしたお客様に<br class="lg">
                  喜んでいただけるパッケージを実現できないか。<br class="lg">
                  aya & co.ではこの課題に取り組んでいます。<br>
              </p>
              <p class="description">
                  まず挑戦しているのは、緩衝材としてプラスチックや紙の個別の箱を使用しないこと。<br class="lg">
                  試行錯誤した結果、「木綿（もくめん）」といって、天然の木材からできた緩衝材を使用してみることにしました。<br>
              </p>
              <div class="divider-image pine-image">
            <v-img
                max-width=90
                class="mx-auto"
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/pine_tree.png"
            ></v-img>
            </div>
              <p class="description">
                  <!-- <v-img
                      max-width=300
                      src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/mokumen.png"
                  ></v-img> -->
                  木の伐採は環境に良くないと思われがちですが、日本の森林は、その環境を守るためにも、<br class="lg">
                  また、地滑りなどの災害から人々の生活を守るためにも、<br class="lg">
                  伐採と植林というサイクルを繰り返すことが重要だそうです。<br>
                  ところが近年の、より安価な外国産の木材の流通によって、<br class="lg">
                  日本の森林は適切な伐採が行われていない状態だそうです。<br>
                  また、昭和初期まで日本で緩衝材として広く使われていた木材ですが、<br class="lg">
                  プラスチック製の緩衝材の利用が広まり、使われることは少なくなっています。<br>
              </p>
              <p class="description">
                  木綿の利用は、環境に負荷のかからないパッケージを実現するだけでなく<br class="lg">
                  日本が誇る美しい森林を守ることにもつながっています。<br class="lg">
                  そこでaya & co.では高知県産の木綿（松）を使用して、お客様に商品をお届けいたします。<br>
                  お客様からのご意見もいただきながら、引き続き、試行錯誤を続けていきたいと考えています。<br>
              </p>
          </v-col>
      </v-row>
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
.mb60 {
  margin-bottom: 60px;

}

@media(max-width:780px){
    .pine-image{
      max-width: 90px;
    }
}

</style>