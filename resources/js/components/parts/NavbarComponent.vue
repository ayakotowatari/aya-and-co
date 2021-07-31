<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >
        <v-app-bar-nav-icon
            @click.stop="drawer = !drawer"
        ></v-app-bar-nav-icon>
        
        
        <v-spacer></v-spacer>
        
        <router-link
            to="/"
        >
            <v-toolbar-title>
                <v-img
                    max-width=120
                    src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg"
                >
                </v-img>
            </v-toolbar-title>
        </router-link>
        <v-spacer></v-spacer>
        <v-badge
            color="error"
            :content="cartQuantity"
            :value="itemNumber"
            class="mr-4"
            overlap
        >            
            <v-icon
                @click="$router.push({name: 'cart'})"
            >$vuetify.icons.basket</v-icon>
        </v-badge>
    </v-app-bar>

    <v-navigation-drawer
        v-model="drawer"
        app
        temporary
        :close-on-content-click="closeOnContentClick"
    >
        <v-row>
            <v-col cols="12" align="center" class="mt-5">
                <v-img
                    max-width=90
                    src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/orange.png"
                >
                </v-img>
            </v-col>
            <!-- <v-col class="mt-4 mb-3 text-center">
                <Popup @projectAdded="snackbar = true"/>
            </v-col> -->
        </v-row>
        <v-list
            nav
            dense
        >
            <v-list-item-group
                v-model="group1"
                color="primary"
            >
                <v-list-item v-for="link in links" :key="link.title" router :to="link.route">
                    <v-list-item-title class="jp-font-300">{{link.title}}</v-list-item-title>
                </v-list-item>
                <!-- <v-list-item router :to="home">
                    <v-list-item-title class="jp-font-300">ホーム</v-list-item-title>
                </v-list-item>
                  <v-list-item router :to="cart">
                    <v-list-item-title class="jp-font-300">カート</v-list-item-title>
                </v-list-item> -->
            </v-list-item-group>

            <v-divider class="my-2"></v-divider>

             <v-list-group
                :value="true"
                no-action
            >
                <template v-slot:activator>
                    <v-list-item-title class="jp-font-300">商品アイテム</v-list-item-title>
                </template>

                    <v-list-item
                        v-for="product in products" :key="product.title"
                        route :to="product.route"
                    >
                        <v-list-item-title v-text="product.title" class="product-name"></v-list-item-title>
                    </v-list-item>

            </v-list-group>

            <v-divider class="my-2"></v-divider>

            <v-list-group
                :value="true"
                v-if="user !== null"
                no-action
            >
                <template v-slot:activator>
                    <v-list-item-title class="jp-font-300">会員専用</v-list-item-title>
                </template>

                    <v-list-item
                        v-for="item in members" :key="item.title"
                        route :to="item.route"
                    >
                        <v-list-item-title v-text="item.title" class="jp-font-300"></v-list-item-title>
                    </v-list-item>
                    <v-list-item
                        @click="logout"
                    >
                        <v-list-item-title>ログアウト</v-list-item-title>
                            <form id="logout-form" action="/logout" method="POST">
                            <input type="hidden" name="_token" :value="token">
                            </form>
                    </v-list-item>

            </v-list-group>

            <v-list-item-group
                v-model="group2"
                v-if="user === null"
                color="primary"
            >
                <v-list-item
                    v-for="item in guests" :key="item.title"
                    route :to="item.route"
                >
                    <v-list-item-title v-text="item.title" class="jp-font-300"></v-list-item-title>
                </v-list-item>
            </v-list-item-group>

            <v-divider class="my-2"></v-divider>

             <v-list-item-group
                v-model="group3"
                color="primary"
            >
                <v-list-item
                    v-for="item in items" :key="item.title"
                    route :to="item.route"
                >
                    <v-list-item-title v-text="item.title" class="jp-font-300"></v-list-item-title>
                </v-list-item>
            </v-list-item-group>

        </v-list>
    </v-navigation-drawer>

  </nav>
</template>

<script>
import { mapState } from 'vuex'

  export default {
    props: {
        user: Object
    },
    data: () => ({
        drawer: false,
        group1: null,
        group2: null,
        group3: null,
        // itemNumber: 0,
      links: [
        { title: 'ホーム', route: '/' },
        { title: 'お買いものかご', route: '/cart' },
        { title: '環境にやさしい包装について', route: '/sustainability'},
       ],
      products: [
        { title: 'Vintage', route: '/products/1' },
        { title: 'Morning', route: '/products/2' },
        { title: 'Serenity', route: '/products/5' },
        { title: 'Blush', route: '/products/6' },
        { title: 'Miss You', route: '/products/9' },
        { title: 'Praise', route: '/products/12' },
        { title: 'Twilight', route: '/products/13' },
      ],
      members: [
        {title: '注文履歴', route: '/member/summary'},
        {title: 'プロフィール編集', route: "/member/profile"},
        {title: '配送先の編集', route: "/member/addresses"},
      ],
      guests: [
        {title: 'ログイン', route: "/guest/login"},
        {title: '会員登録', route: '/guest/register'},
      ],
      items:  [
        {title: 'お問い合わせ', route: '/contact'},
        {title: 'よくある質問', route: "/faq"},
        {title: '特定商取引法に基づく表記', route:"/policy"}
      ],
      closeOnContentClick: true,
    }),
    watch: {
        group(){
            this.drawer = false
        },
    },
    mounted() {
        // this.$store.dispatch('student/fetchStudentUser');
        // this.$store.dispatch('student/fetchInitials');
    },
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        },
        ...mapState([
            'cart',
            // 'user',
            // 'initials',
            // 'isLoggedIn',
        ]),
        itemNumber(){
            if(this.cart.length > 0){
                return true
            }else{
                return false
            }
        },
        cartQuantity(){
            return this.$store.state.cart.reduce((acc,item) => acc + Number(item.quantity), 0);
        },
    },
    methods: {
        logout() {
            document.getElementById('logout-form').submit();
        },
        toTopPage(){
          this.$router.push({path: '/'})
        },
        // toLogin(){
        //     window.location.href = "/student/login";
        // },
        toLogin(){
          this.$router.push({name: 'login'})
        },
        toRegister(){
          this.$router.push({name: 'register'})
        }
    }
  }
</script>
<style>
.jp-font-300{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 300;
  letter-spacing: 0.03em;
}

.v-list--dense .v-list-item .v-list-item__title{
   font-weight:400;
}

.top-title{
    font-family: mrs-eaves-roman-all-small-ca, sans-serif;
    font-weight: 400;
    font-style: normal;
}
.v-toolbar__content{
    margin-bottom: 40px;
}

</style>