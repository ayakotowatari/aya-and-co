<template>
  <v-container>
      <div class="key-visual">
        <v-img
            src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/key_bagel.JPG"
        ></v-img>
      </div>
      <v-row>
          <v-col>
              <div>
                  <p class="key-message">
                    心地よい時間をつくる<br class="sm">一瓶のマーマレード。<br>
                    目を覚ます。<br>
                    ほっとする。<br>
                    自分をねぎらう。<br>
                    大切な人を想う。<br>
                    静けさを噛みしめる。<br>
                    一歩をふみだす。
                  </p>
              </div>
          </v-col>
      </v-row>
      <div class="divider-image">
         <v-img
             max-width=90
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/spoon.png"
          ></v-img>
      </div>
      <div class="heading">
        Little Black Jars
      </div>
      <p class="description">
        日本各地の農家さんによって大切に栽培された有機・無農薬果物・減農薬果物や、ワックス・防腐剤等を用いずに育てられた柑橘類を用いて、
        イギリスに長くつたわる伝統的な製法を再現し、一つ一つ、心をこめて丁寧につくるマーマレードです。
      </p>   
      <p class="description mb-12">
        毎日の大切な時間にそっとよりそう、黒い小瓶たちです。
      </p> 
      <v-row class="mb-12">
        <v-col cols="12" sm="12" md="4">
            <div class="subheading">
              How to Shop
            </div>
            <div class="subheading-jp">
              お買い物の方法
            </div>
        </v-col>
        <v-col cols="12" sm="12" md="8">
            <p class="description">
              aya & co. は、リアルな店舗をもたず、このウェブサイト上の店でのみ、商品を販売しております。aya & co. でのショッピングをどうぞお楽しみください。
            </p>
            <v-row>
                <v-col cols="12" sm="12" md="8">
                    <v-timeline
                      align-top
                      dense
                    >
                        <v-timeline-item small class="description">商品リストから、お好きなマーマレードを選んでカートに入れてご注文ください。</v-timeline-item>
                        <v-timeline-item small class="description">お買い物のまえに、「<router-link to="/postage">配送方法と送料について</router-link>」をお読みいただくと、ご注文の手続きをスムーズに進めていただけます。</v-timeline-item>
                        <v-timeline-item small class="description">会員登録をいただいたお客様には、人気の「<router-link to="/message-service">選べるメッセージカードサービス</router-link>」(無料)をご利用いただけます。ご注文の際にはぜひご活用ください。</v-timeline-item>
                        <v-timeline-item small class="description">Little Black Jars をご指定の宛先までお届けいたします。</v-timeline-item>
                    </v-timeline>
                </v-col>
            </v-row>
        </v-col>
      </v-row>
      
      <v-row class="mb-8">
          <v-col cols="12" sm="12" md="4">
              <div class="subheading">
                Products List
              </div>
              <div class="subheading-jp">
                商品ラインナップ
              </div>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <p class="description">
                  aya & co. では、季節の旬の果物を仕入れて、small batch（少量生産）にて商品を製造します。ほとんどはシーズンの短期間のみの販売となりますので、気に入られた商品は、ぜひお早めにお求めください。
              </p>
          </v-col>
      </v-row>
      
      
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
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        user: Object,
    },
    data: function(){
        return {
            tab: null,
            // id: this.$route.params.id
            // message: "",
            // quantity: [1, 2, 3],
            // selectedQuantity:[],
        }
    },
    mounted(){
      // this.$store.dispatch('fetchProducts')
    },
    created(){
      // this.$store.dispatch('fetchProducts');  

        // this.fetchProducts();

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
     ...mapState([
          'categories',
        ]),
    },
    methods: {
        ...mapActions([
          // 'addToCart'
        ]),
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        expand(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        // formatPrice(value){
        //   let amount = value;

        //   return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        // },

        // @click="$store.commit('addToCart', {product, selectedQuantity})"

        // add(){
        //   this.addToCart({
        //     products: this.products,
        //     quantity: this.selectedQuantity
        //   })

        // },
        //  @click="add()"
        

        // 
        

        // toCart(){
        //   this.$router.push({name: 'carttwo'})
        // }

        // fetchProducts: function(){
        //     axios.get("/fetch-product").then(res => {
        //         this.products = res.data.products;
        //     })
        // },
       
    }

}
</script>

<style>
.key-visual{
  margin-top: 20px;
  margin-bottom: 48px;
}

.key-message{
  line-height: 2.0;
  font-family: 'Noto Serif JP', serif;
  font-weight: 400;
  font-style: normal;
  font-size: 18px;
  margin-bottom: 48px;
}

.divider-image{
  margin-top: 40px;
  margin-bottom: 56px;
}

.heading{
  font-family: mrs-eaves-roman-all-small-ca, sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 40px;
  margin-bottom: 24px;
}

.description{
  line-height: 1.5;
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 300;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  color: rgba(0, 0, 0, 0.6)
  /* color: #424242 */
}

.subheading{
  font-family: mrs-eaves, serif;
  font-weight: 400;
  font-style: normal;
  font-size: 24px;
}

.subheading-jp{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}

.product-name{
  /* font-family: ltc-kennerley, serif;
  font-weight: 700;
  font-style: normal; */
  /* font-family: ltc-kennerley, serif;
  font-weight: 400;
  font-style: normal; */
  font-family: copperplate, serif;
  font-weight: 700;
  font-style: normal;
  font-size: 18px;
  letter-spacing: 0.03em;
  color: rgba(0, 0, 0, 0.87)
}
.product-size{
  font-family: mrs-eaves, serif;
  font-weight: 400;
  font-style: normal;
}

.product-price{
  /* font-family: mrs-eaves, serif;
  font-weight: 400;
  font-style: normal; */
  font-family: ltc-kennerley, serif;
  font-weight: 400;
  font-style: normal;
  letter-spacing: 0.03em;
  font-size: 16px;
}

.product-details{
  font-size: 12px;
  letter-spacing: 0.03em;
}

.sm {
  display: none
}

.logo-title{
    font-family: mrs-eaves, serif;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
}

@media(max-width:780px){
    .key-visual{
      margin-bottom: 32px;
    }

    .key-message{
        font-size: 18px;
    }

    .sm{
        display:block;
    }

    .divider-image{
      max-width: 60px;
      margin: 48px auto;
    }
}

</style>