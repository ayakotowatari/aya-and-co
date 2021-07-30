<template>
  <v-container>
      <div class="key-visual">
        <v-img
            src="../assets/img/IMG_9503.JPG"
        ></v-img>
      </div>
      <v-row>
          <v-col>
              <div>
                  <p class="key-message">
                    心地よい時間をつくらない<br class="sm">一瓶のマーマレード。<br>
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
             src="../assets/img/spoon.jpeg"
          ></v-img>
      </div>
      <div class="heading">
        Little Black Jars
      </div>
      <p class="description">
        国産の有機・無農薬果物や、ワックス・防腐剤等を用いずに育てられた柑橘類をつかい、
        伝統的な製法を再現して、一つ一つ丁寧につくる、マーマレードです。季節により、ジャムもつくります。
      </p>   
      <p class="description mb-8">
        毎日の大切な時間にそっとよりそう、黒い小瓶たちです。
      </p> 
      <div class="subheading">
        Products List
      </div>
      <div class="subheading-jp">
        商品ラインナップ
      </div>
      <v-row>
          <v-col cols="12" sm="12" md="3" v-for="category in categories" :key="category.id">
              <v-card
                class="mx-auto"
                max-width="344"
                outlined
                
              >
                <v-img
                    height="150"
                    src="../assets/img/IMG_9502.JPG"
                > 
                </v-img>
                <v-card-text>
                    <div class="product-name mb-1">
                        {{category.name}}
                    </div>
                    <div class="product-season mb-4">
                        {{category.season}}
                    </div>
                    <!-- <div class="product-size mb-2">
                      {{product.size}}
                    </div> -->
                    <!-- <div class="product-price mb-4">
                        {{formatPrice(product.price)}}
                    </div> -->
                    <div class="product-details">
                        {{category.details}}
                    </div>
                </v-card-text>

                <!-- <v-list-item three-line>
                  <v-list-item-content>
                    <div class="product-name mb-1">
                      {{product.name}}
                    </div>
                    <div class="product-size mb-4">
                      {{product.size}}
                    </div>
                    <div class="product-price mb-6">
                        {{formatPrice(product.price)}}
                    </div>
                    <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                  </v-list-item-content>

                  <v-list-item-avatar
                    tile
                    size="80"
                    color="grey"
                  ></v-list-item-avatar>
                </v-list-item>
                -->
                <div class="link">
                    <router-link
                        :to="{
                          name: 'products',
                          params: {id: category.id}
                        }"
                        @click.native="scrollToTop"
                    >
                        <v-card-actions>
                          <v-btn
                            outlined
                            rounded
                            text
                            @click.prevent="expand(category.id)"          >
                            詳細
                          </v-btn>
                        </v-card-actions>
                    </router-link>
                </div>
              </v-card>
          </v-col>
      </v-row>
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
        

        toCart(){
          this.$router.push({name: 'carttwo'})
        }

        // fetchProducts: function(){
        //     axios.get("/fetch-product").then(res => {
        //         this.products = res.data.products;
        //     })
        // },
        //ここはもうプロダクトが一つ選ばれている状態から、カートに入れられる。一つ一つ入っていく。

        // addToCart(id){
        //     axios.post("/cart", {
        //       product_id: id,
        //       quantity: 2,
        //     })
        //     .then(res => {
        //       // this.$router.push({name: 'cart-component'})
        //       console.log("added successfully");
        //     })
        //     .catch(err => {
        //       this.message = err;
        //     })

        // }
       
      // fetchUser: function() {
      //     axios.get("/inst/fetch-user").then(res => {
      //       this.user = res.data.user;
      //     });
      // },

      // fetchInst: function() {
      //     axios.get("/inst/fetch-inst").then(res => {
      //       this.inst = res.data.inst;
      //     });
      // },

      // fetchInitials: function() {
      //     axios.get("/inst/fetch-initials").then(res => {
      //       this.initials = res.data.initials;
      //     });
      // },
      // fetchEvents: function() {
      //     axios.get("/inst/fetch-events").then(res => {
      //       this.events = res.data.events;
      //     })
      // },
      // fetchLevels: function() {
      //     axios.get("/inst/fetch-levels").then(res => {
      //       this.levels = res.data.levels;
      //     })
      // },
      // fetchSubjects: function() {
      //     axios.get("/inst/fetch-subjects").then(res => {
      //       this.subjects = res.data.subjects;
      //     })
      // },
      // fetchRegions: function() {
      //     axios.get("/inst/fetch-regions").then(res => {
      //       this.regions = res.data.regions;
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