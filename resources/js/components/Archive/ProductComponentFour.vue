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
                  <div class="page-subtitle grey--text text--darken-3">
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
              <div v-if="product.length >= 2" class="note">
                  購入したい商品をタップして、数量を選び、カートに入れます。
              </div>
              <v-row v-if="product.length <= 0">
                <v-col>
                  <div class="message">
                    商品のご購入は、シーズンまでしばらくお待ちください。
                  </div>
                </v-col>
              </v-row>
              <div v-if="product.length >= 1">
                <v-list-item-group v-model="itemGroup">
                    <v-row>
                        <v-col cols="12" sm="12" md="5">
                            <v-list-item v-for="(item, index) in product" :key="item.id" :value='index'>
                                <v-card
                                      :class="{'elevation-6': activeIndex === index}"
                                      class="mx-auto mb-6"
                                      outlined
                                      @click="inventory(item.id, index)"
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
                          </v-card>
                            </v-list-item>
                        </v-col>
                    </v-row>
                </v-list-item-group>
              
              <v-row>
                  <v-col cols="4" sm="4" md="2">
                      <v-select
                          v-model="selectedQuantity"
                          :items="selectableNumbers"
                          label="数量"
                          required
                      ></v-select>
                  </v-col>
              </v-row>
              <div class="mb48">
                  <v-btn
                      outlined
                      text
                      @click="add(item)">
                      カートに入れる
                  </v-btn>
                  <v-btn
                      v-if="cart !== null"
                      outlined
                      text
                      @click="$router.push({name: 'cart'})"
                  >
                      カートをみる
                  </v-btn>
              </div>
              </div>
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
                    <div class="product-details">
                        {{otherCategory.details}}
                    </div>
                </v-card-text>
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
            // options: [1, 2, 3],
            itemGroup: {},
            selectedQuantity: 1,
            id: Number(this.$route.params.id),
            activeIndex: 0,
            active: false,
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
    },
    computed: {
        ...mapState([
          'products',
          'product',
          'categories',
          'user',
          'cart',
          'inventoryQuantity',
          'selectableNumbers',
          // 'selectedItem'
          // 'product'
        ]),
        category(){
          return this.categories.find(category => category.id === Number(this.id));
        },
        otherCategories(){
          return this.categories.filter(category => category.id !== Number(this.id));
        },
        // value(){
        //   return {
        //       id: this.item.id,
        //       slug: this.item.slug
        //   }
        // }
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
          'addToCart',
          'fetchInventory'
        ]),
        inventory(id, index){
            // console.log('value', value)
            this.activeIndex = index;
            // this.$store.commit('setItemGroup', value);
            this.fetchInventory({
                product_id: id
            })
        },
        // inventory(value){
        //   console.log('value', value)
        // },
        add(){
            // console.log('item', value);
            let item = this.itemGroup;
            console.log('item', item)
            let quantity = this.selectedQuantity
            this.$store.commit('addToCart', {item, quantity})
        },
        formatPrice(value){

          return value.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'})
        },
        toCart(){
          this.$router.push({name: 'cart'})
        },
        expand(value){
          this.$router.go({name: 'products', params: {id: value}, force: true})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        updateQuantity(item, value){
            item.quantity = value
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

.note{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
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

.v-list-item--link:before{
  background-color: transparent !important;
}

</style>