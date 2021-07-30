<template>
  <v-container>
      <div class="page-visual">
          <v-img
              src="../assets/img/IMG_9502.JPG"
          ></v-img>
      </div>
      <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    {{category.name}}
                  </div>
                  <div class="page-subtitle text--lighten-5">
                    {{category.subtitle}}
                  </div>
              </div>
          </v-col>
      </v-row>
      <v-row align="start">
          <v-col cols="12" sm="12" md="4">
              <div class="mb-6">
                <div class="item-title">
                  シーズン
                </div>
                <div class="item-content">
                  {{category.season}}
                </div>
              </div>
              <div class="mb-6">
                <div class="season-title">
                  主原材料
                </div>
                <div v-html="category.ingredients" class="item-content">
                </div>
              </div>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <div class="subheading-group">
                  <div class="subheading">
                      Shop Here
                  </div>
                  <div class="subheading-jp">
                      お買いもの
                  </div>
              </div>
              <v-row v-if="product.length <= 0">
                <v-col>
                  <div class="message">
                    商品のご購入は、シーズンまでしばらくお待ちください。
                  </div>
                </v-col>
              </v-row>
              <v-row v-if="product.length >= 1">
                  <v-col cols="12" sm="12" md="4" v-for="item in product" :key="item.id">
                      <v-card
                        class="mx-auto"
                        outlined
                      >
                        <v-list-item three-line>
                          <v-list-item-content>
                            <div class="product-name mb-1">
                              {{item.name}}
                            </div>
                            <div class="product-size mb-4">
                              {{item.size}}
                            </div>
                            <div class="product-price mb-6">
                              {{formatPrice(item.price)}} <span class="tax">（税込）</span>
                            </div>
                          </v-list-item-content>
                          <v-list-item-avatar
                            tile
                            size="80"
                            color="grey"
                          >
                            <v-img
                              src="../assets/img/IMG_9502.JPG"
                            ></v-img>
                          </v-list-item-avatar>
                        </v-list-item>
                        <v-form ref="form">
                            <v-card-text>
                                <v-row>
                                    <v-col cols="4" sm="4" md="4">
                                        <v-select
                                            v-model="selectedQuantity"
                                            :items="quantity"
                                            label="数量"
                                            required
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-card-text>    

                            <v-card-actions>
                              <v-btn
                                outlined
                                rounded
                                text
                                @click="$store.commit('addToCart', {item, selectedQuantity})">
                                カートに入れる
                              </v-btn>
                            </v-card-actions>
                        </v-form>
                      </v-card>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <div v-html="category.description" class="description mt24">
                      </div>
                    </v-col>
                </v-row>
            </v-col>
      </v-row>
        <div class="divider-image">
         <v-img
             max-width=90
             class="mx-auto"
             src="../assets/img/lemon.png"
          ></v-img>
        </div>
        <div class="subheading">
            Other Items
        </div>
        <div class="subheading-jp">
            そのほかの商品
        </div>
        <v-row>
          <v-col cols="12" sm="12" md="3" v-for="otherCategory in otherCategories" :key="otherCategory.id">
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
                        {{otherCategory.name}}
                    </div>
                    <div class="product-season mb-4">
                        {{otherCategory.season}}
                    </div>
                    <!-- <div class="product-size mb-2">
                      {{product.size}}
                    </div> -->
                    <!-- <div class="product-price mb-4">
                        {{formatPrice(product.price)}}
                    </div> -->
                    <div class="product-details">
                        {{otherCategory.details}}
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
                  <v-card-actions>
                    <router-link
                        :to="{
                          name: 'products',
                          params: {id: otherCategory.id}
                        }"
                        @click.native="scrollToTop"
                    >
                        <v-btn
                          outlined
                          rounded
                          text  >
                          詳細
                        </v-btn>
                    </router-link>
                  </v-card-actions>
                </div>
              </v-card>
          </v-col>
      </v-row>

  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            // id: this.$route.params.id
            message: "",
            quantity: [1, 2, 3],
            selectedQuantity:"",
            id: Number(this.$route.params.id),
        }
    },
    watch: { 
    },
    mounted(){
      // this.$store.dispatch('fetchProduct', {
      //       id: this.id
      // })
    },
    created(){
      this.$store.dispatch('fetchProduct', {
        id: this.id
      })
      // this.$store.dispatch('fetchProduct', {
      //       id: this.id
      // })
      // this.$store.dispatch('fetchProducts');  

        // this.fetchProducts();

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
        ...mapState([
          'products',
          'product',
          'categories',
          'user',
          // 'product'
        ]),
        category(){
          return this.categories.find(category => category.id === Number(this.id));
        },
        otherCategories(){
          return this.categories.filter(category => category.id !== Number(this.id));
        },
        // eachProduct(){
        //     let name = this.products.find(product => product.category_id === Number(this.id));
        //     // return this.products.find(product => product.category_id === Number(this.id));
        //     console.log('name', name)
        //     return name;
        // },
        // formatPrice(){
        //   let amount = this.item.price;

        //   return amount.toLocaleString('ja-JP', {style: 'currency', currency: 'JPY'});
        // }
        // product(){
        //   let product = this.products.filter(product => product.category_id === Number(this.id));
        //   console.log('result', product.length)
        // },

    },
    methods: {
        ...mapActions([
          'addToCart'
        ]),
        formatPrice(value){
          console.log(value);

          return value.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'})
        },
        toCart(){
          this.$router.push({name: 'cart'})
        },
        expand(value){
          console.log('paramId', value)
          this.$router.go({name: 'products', params: {id: value}, force: true})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        }
    }

}
</script>

<style>
.mb48{
  margin-bottom: 48px;
}

.mt48{
  margin-top: 48px;
}

.mt24{
  margin-top: 24px;
}

.message{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
}

.link a{
  text-decoration: none;
}

.page-visual{
  margin-top: 20px;
  margin-bottom: 32px;
}

.heading-group{
  margin-top: -16px;
}

.subheading-group{
  /* margin-top: 24px; */
}

.page-heading{
  font-family: mrs-eaves-roman-all-small-ca, sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 40px;
}

.page-subtitle{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
  letter-spacing: 0.03em;
  margin-top: -10px; 
  margin-bottom: 24px;
}

.item-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
}

.item-content{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 300;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
}

.lemon{
  margin-top: 12px;
  margin-bottom: 60px;
}

.description{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  line-height: 1.5;
}

.tax{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
  letter-spacing: 0.03em;
}

</style>