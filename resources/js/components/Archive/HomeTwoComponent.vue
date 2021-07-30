<template>
  <v-container>
  <v-row>
      <v-col cols="12" sm="12" md="3" v-for="(product, index) in products" :key="product.slug">
          <v-card
            class="mx-auto"
            max-width="344"
            outlined
            
          >
            <v-list-item three-line>
              <v-list-item-content>
                <div class="text-overline mb-4">
                  {{product.name}}
                </div>
                <v-list-item-title class="text-h5 mb-1">
                  {{product.size}}-{{product.price}}
                </v-list-item-title>
                <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
              </v-list-item-content>

              <v-list-item-avatar
                tile
                size="80"
                color="grey"
              ></v-list-item-avatar>
            </v-list-item>
            <v-card-text>
                <v-row>
                    <v-col cols="4" sm="4" md="4">
                        <label for="">数量</label>
                        <select :value="selectedQuantity[index]">
                            <option value=1>1</option>
                            <option value=2>2</option>
                            <option value=3>3</option>
                            <option value=4>4</option>
                            <option value=5>5</option>
                            <option value=6>6</option>
                            <option value=7>7</option>
                            <option value=8>8</option>
                            <option value=9>9</option>
                        </select>
                    </v-col>
                </v-row>
            </v-card-text>    

            <v-card-actions>
              <v-btn
                outlined
                rounded
                text
                @click="$store.commit('addToCart', {product, selectedQuantity})"          >
                カートに入れる
              </v-btn>
            </v-card-actions>
            <v-card-actions>
              <v-btn
                outlined
                rounded
                text
                @click="toCart()"
              >
                カートをみる
              </v-btn>
            </v-card-actions>
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
            selectedQuantity:[],
        }
    },
    mounted(){
      this.$store.dispatch('fetchProducts')
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
          'products'
        ])
    },
    methods: {
        ...mapActions([
          'addToCart'
        ]),

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

</style>