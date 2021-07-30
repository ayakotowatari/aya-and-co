<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >
        <!-- <v-img
            height=auto
            max-width=120
            src="../assets/img/logo_1.png"
        >
        </v-img> -->
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-spacer></v-spacer>
        <!-- <router-link to="/">
            <v-img
                height=auto
                max-width=120
                class="mt-4 ml-4"
                src="../assets/img/logo_1.png"
                >
            </v-img>
        </router-link> -->
        
      <v-toolbar-title>
          <v-img
                height=auto
                max-width=120
                class="mt-4 ml-4"
                src="../assets/img/logo_1.png"
                >
            </v-img>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <!-- <v-btn text color="grey darken-1" @click.stop="toTopPage">
            <span>ホーム</span> -->
            <!-- <v-icon>mdi-home-variant-outline</v-icon> -->
      <!-- </v-btn> -->
      <v-menu
          v-if="user == null && $vuetify.breakpoint.xs"
          top
          offset-y
          :close-on-content-click="closeOnContentClick"
      >
          <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="primary"
                    text
                    v-bind="attrs"
                    v-on="on"
                  >
                    <span class="mr-1">sign in</span>  
                  </v-btn>
          </template>
          <v-list>
              <v-list-item
                  :to="{name:'login'}"
              >
                  <v-list-item-action>
                      <v-icon class="grey--text text--darken-3">mdi-login-variant</v-icon>
                  </v-list-item-action>
                  <v-list-item-action>
                      <v-list-item-title class="grey--text text--darken-3">Log in</v-list-item-title>
                  </v-list-item-action>
              </v-list-item>
              <v-list-item
                  :to="{name:'register'}"
              >
                  <v-list-item-action>
                      <v-icon class="grey--text text--darken-3">mdi-account-plus-outline</v-icon>
                  </v-list-item-action>
                  <v-list-item-action>
                      <v-list-item-title class="grey--text text--darken-3">Register</v-list-item-title>
                  </v-list-item-action>
              </v-list-item>
          </v-list>
      </v-menu>
       <v-menu 
          v-if="user !== null"
          open-on-hover 
          top 
          offset-y
          :close-on-content-click="closeOnContentClick"
      >
          <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                text
                v-bind="attrs"
                v-on="on"
              >
                <span class="mr-1">menu</span>  
                <v-icon>mdi-account-outline</v-icon>
              </v-btn>
          </template>
          <v-list>
              <v-list-item text @click="logout">
                  <v-list-item-action>
                      <v-icon left class="grey--text text--darken-1">mdi-logout-variant</v-icon>
                  </v-list-item-action>
                  <v-list-item-content>
                  <v-list-item-title class="grey--text text--darken-1">Log out</v-list-item-title>
                      <form id="logout-form" action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="token">
                      </form>
                  </v-list-item-content>
              </v-list-item>
          </v-list>
    </v-menu>
      <v-btn 
          v-if="user == null"
          class="hidden-sm-and-down"
          text color="primary" 
          @click.stop="toLogin"
      >
          <span>Log in</span>
      </v-btn>
      <v-btn 
          v-if="user == null"
          class="hidden-sm-and-down"
          text color="primary" 
          @click.stop="toRegister"
      >
          <span>Register</span>
      </v-btn>
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

  </nav>
</template>

<script>
import { mapState } from 'vuex'

  export default {
    props: {
        user: Object
    },
    data: () => ({
        // itemNumber: 0,
    //   links: [
    //     { icon: 'mdi-calendar-month-outline', text: 'Booked Events', route: 'booked-events' },
    //     { icon: 'mdi-eye-outline', text: 'Following', route: 'following' },
    //     { icon: 'mdi-heart-outline', text: 'Liked', route: 'liked'},
    //     { icon: 'mdi-account-details-outline', text: 'My Profile', route: 'student-profile' },
    //    ],
      closeOnContentClick: true,
    }),
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
.top-title{
    font-family: mrs-eaves-roman-all-small-ca, sans-serif;
    font-weight: 400;
    font-style: normal;
}

</style>