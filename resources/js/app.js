/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from "./router";
import Vuetify from 'vuetify';
import store from './store/';
import AppComponent from "./components/AppComponent";

import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


Vue.component('navbar-component', require('./components/parts/NavbarComponent.vue').default);
Vue.component('footer-component', require('./components/parts/FooterComponent.vue').default);
Vue.component('updatecartquantitydialog-component', require('./components/UpdateCartQuantityDialogComponent.vue').default);
Vue.component('removecartitemdialog-component', require('./components/RemoveCartItemDialogComponent.vue').default);

//user
// Vue.component('changeaddress-component', require('./components/ChangeAddressComponent.vue').default);
// Vue.component('otheraddressdialog-component', require('./components/user/OtherAddressDeliveryTimeDialogComponent.vue').default);
Vue.component('checkaddress-component', require('./components/user/CheckAddressTwoComponent.vue').default);
// Vue.component('homeaddress-component', require('./components/user/HomeAddressComponentThree.vue').default);
Vue.component('homeaddress-component', require('./components/user/HomeAddressComponentFour.vue').default);
Vue.component('otheraddress-component', require('./components/user/OtherAddressTwoComponent.vue').default);
Vue.component('deliveryoption-component', require('./components/user/DeliveryOptionComponent.vue').default);
Vue.component('orderconfirmation-component', require('./components/user/OrderConfirmationTwoComponent.vue').default);
Vue.component('checkout-component', require('./components/user/CheckoutThreeComponent.vue').default);
Vue.component('editaddressdialog-component', require('./components/user/EditAddressDialogComponent.vue').default);
Vue.component('newaddressdialog-component', require('./components/user/NewAddressDialogComponent.vue').default);
Vue.component('removeaddressdialog-component', require('./components/user/RemoveAddressDialogComponent.vue').default);
Vue.component('checkoutsnackbar-component', require('./components/user/CheckoutSnackbarComponent.vue').default);
Vue.component('thankyou-component', require('./components/user/ThankYouDialogComponent.vue').default);
// Vue.component('requestreset-component', require('./components/user/password/RequestResetComponent.vue').default);
// Vue.component('linksentsnackbar-component', require('./components/user/password/LinkSentSnackbarComponent.vue').default);
Vue.component('resetform-component', require('./components/user/password/ResetFormComponent.vue').default);
Vue.component('linksentdialog-component', require('./components/user/password/LinkSentDialogComponent.vue').default);
Vue.component('editname-component', require('./components/user/edit/EditNameComponent.vue').default);
Vue.component('editaddress-component', require('./components/user/edit/EditAddressComponent.vue').default);
Vue.component('editemail-component', require('./components/user/edit/EditEmailComponent.vue').default);
Vue.component('editpassword-component', require('./components/user/edit/EditPasswordComponent.vue').default);
Vue.component('deleteuserdialog-component', require('./components/user/edit/DeleteUserDialogComponent.vue').default);

//guest
Vue.component('guestcheckaddress-component', require('./components/guest/GuestCheckAddressComponent.vue').default);
Vue.component('guestorderconfirmation-component', require('./components/guest/GuestOrderConfirmationComponentTwo.vue').default);
Vue.component('guestcheckout-component', require('./components/guest/GuestCheckoutComponentThree.vue').default);
Vue.component('guesthomeaddress-component', require('./components/guest/GuestHomeAddressComponentTwo.vue').default);
Vue.component('guestotheraddress-component', require('./components/guest/GuestOtherAddressComponentThree.vue').default);
Vue.component('logintoorder-component', require('./components/guest/LoginToOrderComponent.vue').default);
Vue.component('registertoorderdialog-component', require('./components/guest/RegisterToOrderDialogComponent.vue').default);
Vue.component('loginexception-component', require('./components/LoginForExceptionComponent.vue').default);
Vue.component('registerexception-component', require('./components/RegisterForExceptionComponent.vue').default);
Vue.component('thankyouguest-component', require('./components/guest/ThankYouGuestDialogComponentTwo.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);

//icons
import BasketIcon from "./components/icons/BasketIconComponent"

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
            values: {
                basket:{
                    component: BasketIcon,
                },
            }
        },
        theme: {
            themes:{
              light:{
                primary: '#FE6862',
                success: '#509F98',
                info: '#EDB85C',
                error: '#FE6862',
                // background: '#f5f5f5'
              }
            }
        },
    }
    ),
    router,
    store,
    components: {
        "app-component": AppComponent,
    },
    created(){
        store.dispatch('fetchCategories')
        .then(_ => {})
        .catch((error) => console.error(error));
    }
});
