/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 import router from "./router2";
 import Vuetify from 'vuetify';
 import store from './store/';
 import AppTwoComponent from "./components/AppTwoComponent";
 
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
 
 
 // Vue.component('navbar-component', require('./components/parts/NavbarComponent.vue').default);
 Vue.component('navbar-component', require('./components/admin/parts/AdminNavbarComponent.vue').default);
 Vue.component('homenavbar-component', require('./components/admin/parts/HomeNavbarComponent.vue').default);
 Vue.component('footer-component', require('./components/parts/FooterComponent.vue').default);
 
 //admin
 Vue.component('shipmentschedule-component', require('./components/admin/orders/ShipmentScheduleDialogComponent.vue').default);
 Vue.component('updateshipmentschedule-component', require('./components/admin/orders/UpdateShipmentScheduleDialogComponent.vue').default);
 Vue.component('updatestatusdialog-component', require('./components/admin/orders/UpdateStatusDialogComponent.vue').default);
 Vue.component('eachorder-component', require('./components/admin/orders/EachOrderComponent.vue').default);
 Vue.component('adminlogin-component', require('./components/admin/AdminLoginComponent.vue').default);
 Vue.component('adminregister-component', require('./components/admin/AdminRegisterComponent.vue').default);
 Vue.component('editsubtitle-component', require('./components/admin/products/edit/EditSubtitleComponent.vue').default);
 Vue.component('editdetails-component', require('./components/admin/products/edit/EditDetailsComponent.vue').default);
 Vue.component('editdescription-component', require('./components/admin/products/edit/EditDescriptionComponent.vue').default);
 Vue.component('editseason-component', require('./components/admin/products/edit/EditSeasonComponent.vue').default);
 Vue.component('editingredients-component', require('./components/admin/products/edit/EditIngredientsComponent.vue').default);
 Vue.component('editimage-component', require('./components/admin/products/edit/EditImageComponent.vue').default);
 Vue.component('updateinventory-component', require('./components/admin/products/UpdateInventoryComponent.vue').default);
 Vue.component('updatecategorystatus-component', require('./components/admin/products/edit/UpdateCategoryStatusComponent.vue').default);
 Vue.component('updateproductstatus-component', require('./components/admin/products/edit/UpdateProductStatusComponent.vue').default);
 
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
            //  values: {
            //      basket:{
            //          component: BasketIcon,
            //      },
            //  }
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
         "apptwo-component": AppTwoComponent
     },
    //  created(){
    //      store.dispatch('fetchCategories')
    //      .then(_ => {})
    //      .catch((error) => console.error(error));
    //  }
 });
 