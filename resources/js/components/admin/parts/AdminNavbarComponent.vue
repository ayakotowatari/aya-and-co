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
            to="/admin/orders-list"
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
        <v-btn text color="grey" @click="logout">
            <span>ログアウト</span>
            <v-icon right>mdi-logout-variant</v-icon>
            <form id="logout-form" action="/admin/logout" method="POST">
              <input type="hidden" name="_token" :value="token">
            </form>
        </v-btn>
    </v-app-bar>

    <v-navigation-drawer
        v-model="drawer"
        app
        temporary
    >
        <v-row>
            <v-col cols="12" align="center" class="my-5">
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
        <v-row justify="center">
            <v-col cols="6" sm="6" md="6" class="mb-5">
                 <div class="jp-font-400">
                    {{user.name}}さん
                </div>
            </v-col>
        </v-row>
       
        <v-list
            nav
            dense
        >
            <v-list-item-group
                v-model="group"
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

            <v-divider class="my-2" v-if="user.user_type_id === 6"></v-divider>

             <v-list-item-group
                v-model="group2"
                color="primary"
                v-if="user.user_type_id === 6"
            >
                <v-list-item
                    v-for="list in lists" :key="list.title"
                    route :to="list.route"
                >
                    <v-list-item-title v-text="list.title" class="jp-font-300"></v-list-item-title>
                </v-list-item>
            </v-list-item-group>

             <v-divider class="my-2" v-if="user.user_type_id === 6"></v-divider>

            <v-list-item-group
                v-model="group3"
                color="primary"
                v-if="user.user_type_id === 6"
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
        group: null,
        group2: null,
        group3: null,
        // itemNumber: 0,
      links: [
        { title: '顧客注文リスト', route: '/admin/orders-list' },
        { title: '顧客発送リスト', route: '/admin/shipments-list' },
        { title: 'ゲスト注文リスト', route: '/admin/guestorders-list' },
        { title: 'ゲスト発送リスト', route: '/admin/guestshipments-list' },
        {title: 'お問い合わせ', route: '/admin/enquiries'}
       ],
      lists: [
        { title: 'カテゴリーリスト', route: '/admin/categories-list' },
        { title: '商品リスト', route: '/admin/products-list' },
      ],
      items:  [
        {title: '管理者登録', route: "/admin/register"},
        {title: 'アカウント編集', route: "admin/edit-account" }
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
            // 'user',
            // 'initials',
            // 'isLoggedIn',
        ]),
    },
    methods: {
        logout() {
            document.getElementById('logout-form').submit();
        },
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