<template>
  <v-container>
      <div class="page-visual">
          <v-img
              :src="category.absolute_path"
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
                  原材料
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
                  購入したい商品をタップして、数量を選び、カートに入れてください。
              </div>
              <v-row v-if="product.length <= 0">
                <v-col v-if="category.id !== 7 && category.id !== 8">
                  <div class="message grey--text text--darken-3 mb-3">
                    この商品は、完売、もしくは、シーズン（{{category.season}}）まで準備中です。
                  </div>
                  <div class="message grey--text text--darken-3 mb-6">
                    公式LINEアカウントで、発売日をお知らせしています。ぜひご登録ください。
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
                <v-col v-if="category.id == 7 || category.id == 8">
                  <div class="message mb-3">
                    ただいまこの商品は、Summer Meets Autumn（PraiseとLemonade）のセットとしてご購入いただけます。
                  </div>
                  <div>
                    <v-btn
                        text
                        color="primary"
                        @click="toSet()"
                    >
                      Summer Meets Autumnのセットへ
                    </v-btn>
                  </div>
                </v-col>
              </v-row>
              <div v-if="product.length >= 1 && category.id !== 1">
                    <v-list-item-group v-model="itemGroup">
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-list-item v-for="(item, index) in product" :key="item.id" :value='item'>
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
                                              {{formatPrice(item.price)}} <span class="jp-font-300 tax">（税込・送料別）</span>
                                              </div>
                                              <div v-if="item.inventory <= 5" class="stock jp-font-400 grey--text text--darken-2">
                                                残り{{item.inventory}}個
                                              </div>
                                          </v-list-item-content>
                                          <v-list-item-avatar
                                              tile
                                              size="80"
                                              color="grey"
                                          >
                                              <v-img
                                              :src="category.absolute_path"
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
                    <div class="mb24">
                        <v-btn
                            outlined
                            text
                            @click="add()">
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
                <div v-if="product.length >= 1 && category.id == 1">
                    <v-list-item-group v-model="itemGroup">
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-list-item v-for="(item, index) in product" :key="item.id" :value='item'>
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
                                              {{formatPrice(item.price)}} <span class="jp-font-300 tax">（税込・送料別）</span>
                                              </div>
                                              <div v-if="item.inventory <= 5" class="stock jp-font-400 grey--text text--darken-2">
                                                残り{{item.inventory}}個
                                              </div>
                                          </v-list-item-content>
                                          <v-list-item-avatar
                                              tile
                                              size="80"
                                              color="grey"
                                          >
                                              <v-img
                                              :src="category.absolute_path"
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
                            @click="addOne()">
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
                    <div v-if="cartMessage !== null" class="item-content">
                        <p>{{ cartMessage }}</p>
                    </div>
                </div>
                <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <div v-html="category.description" class="description mt24">
                      </div>
                    </v-col>
                </v-row>
                <div v-if="category.id == 1" class="item-content">
                    <p>現在、こちらの商品は一回のご注文手続きにつき、セット1点までのご購入とさせていただいております。一度ご注文をお済ませになられてから、再度ご注文いただけます。</p>
                </div>
              </v-col>
        </v-row>
        <div class="divider-image">
         <v-img
             max-width=90
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/lemon.png"
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
                @click.prevent="showmore(otherCategory.id)"
              >
                <v-img
                    max-height="200"
                    :src="otherCategory.absolute_path"
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
            // itemGroup:{},
            // item: this.firstItem,
            // selectedQuantity: 1,
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
          // 'products',
          'product',
          'categories',
          'user',
          'cart',
          'cartMessage',
          'inventoryQuantity',
          'selectableNumbers',
          'productQuantity',
          'firstItem'
          // 'disableSelectAmount',
          // 'selectedItem'
          // 'product'
        ]),
        category(){
          return this.categories.find(category => category.id === Number(this.id));
        },
        otherCategories(){
          return this.categories.filter(category => category.id !== Number(this.id));
        },
        itemGroup: {
            get(){                
                return this.firstItem
            },
            set (value) {
                this.$store.commit('setFirstItem', value)
            }
        },
        selectedQuantity: {
            get(){                
                return this.productQuantity
            },
            set (value) {
                this.$store.commit('setProductQuantity', value)
            }
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
          'addOneToCart',
          'fetchInventory'
        ]),
        inventory(id, index){
            // console.log('value', value)
            this.activeIndex = index;
            // this.$store.commit('disableSelectAmount', false);
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
            let cartItem = this.itemGroup;
            console.log('item', cartItem)
            let cartQuantity = this.selectedQuantity
            this.$store.commit('addToCart', {cartItem, cartQuantity})
            this.$store.commit('setProductQuantity', 1);
        },
        addOne(){
            let cartItem = this.itemGroup;
            //console.log('item', cartItem)
            let cartQuantity = this.selectedQuantity
            this.$store.commit('addOneToCart', {cartItem, cartQuantity})
            this.$store.commit('setProductQuantity', 1);
        },
        formatPrice(value){

          return value.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'})
        },
        toCart(){
          this.$router.push({name: 'cart'})
        },
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        expand(value){
          this.$router.go({name: 'products', params: {id: value}, force: true})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        updateQuantity(item, value){
            item.quantity = value
        },
        toSet(){
          this.$router.push({name: 'products', params: {id: 1}})
        }
    }

}
</script>

<style>
.mb80{
  margin-bottom: 80px;
}

.mb48{
  margin-bottom: 48px;
}

.mt48{
  margin-top: 48px;
}

.mt24{
  margin-top: 24px;
}

.lg{
  display: block;
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
  line-height: 1.8;
}

.tax{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 12px;
  letter-spacing: 0.03em;
}

.stock{
  font-size: 14px;
}

.v-list-item--link:before{
  background-color: transparent !important;
}

@media(max-width:780px){
    .page-heading{
      font-size:32px;
    }

    .lg{
      display: none;
    }

    
}

</style>