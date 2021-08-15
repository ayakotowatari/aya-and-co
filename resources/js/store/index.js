import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import router from "../router"

import { admin } from './modules/admin';
 
Vue.use(Vuex)
 
export default new Vuex.Store({

  //vuex-persistedstate
  plugins: [createPersistedState(
      {
        key: 'aya-and-co',
        paths: [
            'cart',
            'guest',
            'deliveryAddress',
            'guestAddress',
            'orders',
        ]
      }
  )],
 
  // 共有するデータ
  state: {
      user: {
          name: '',
          kana: '',
          zipcode: '',
          prefecture: '',
          city: '',
          address_1: '',
          building: '',
          phone: '',
          email: '',
          password: '',
      },
      homeAddress: {},
      otherAddresses: [],
      deliveryAddress: {
          id: '',
          user_id: '',
          name: '',
          kana: '',
          zipcode: '',
          prefecture: '',
          city: '',
          address_1: '',
          building: '',
          phone: '',
          email: '',
          delivery_time: '',
          postage: '',
      },
      postages: {
          
      },
      guest: {
          name: '',
          kana: '',
          zipcode: '',
          prefecture: '',
          city: '',
          address_1: '',
          building: '',
          phone: '',
          email: '',
          delivery_time: '',
      },
      products: [],
      product: [],
      categories: [],
    //   disableSelectAmount: true,
      inventoryQuantity: null,
      //selectableNumbers:[1, 2, 3, 4, 5, 6],
      selectableNumbers: [1],
      productQuantity: 1,
    //   itemGroup: {},
      firstItem: {},
      cart: [],
      cartMessage: null,
      orders: {},
      order: {},
      orderedProducts: [],
      postages: [],
      plannedShipmentDate: null,
      actualShipmentDate: null,
      deliveredDate: null,
      dialog: false,
      dialogThankYou: false,
      dialogThankYouGuest: false,
      dialogEditAddress: false,
      dialogNewAddress: false,
      dialogRemoveAddress: false,
      dialogRegisterToOrder: false,
      dialogLinkSent: false,
      disabled: false,
      disableContinue1: true,
      disableInputEmail: true,
      loading: false,
      isAddingAddress: false,
      isEditingName: false,
      isEditingEmail: false,
      isEditingPassword: false,
      isEditingAddress: false,
      isEditingDeliveryTime: false,
      allerror: [],
      allLoginError: {
        email: null,
        password: null
      },
      allRegisterError: {
        name: null,
        kana: null,
        zipcode: null,
        prefecture: null,
        city: null,
        address_1: null,
        phone: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      errorMessage: null,
      checkoutError: "",
      checkoutSnackbar: false,
      linkSentSnackbar: false,
      lastPage: 1,
      
  },
  
  // ミューテーション
  // ※stateのデータ変更はミューテーションが行う
  mutations: {
    setUser(state, payload){
        state.user = payload
    },
    updateUser(state, payload){
        state.user = payload
    },
    updateUserName(state, payload){
        state.user.name = payload
    },
    updateUserKana(state, payload){
        state.user.kana = payload
    },
    updateUserZipcode(state, payload){
        state.user.zipcode = payload
    },
    updateUserPrefecture(state, payload){
        state.user.prefecture = payload
    },
    updateUserCity(state, payload){
        state.user.city = payload
    },
    updateUserAddress1(state, payload){
        state.user.address_1 = payload
    },
    updateUserBuilding(state, payload){
        state.user.building = payload
    },
    updateUserPhone(state, payload){
        state.user.phone = payload
    },
    updateUserEmail(state, payload){
        state.user.email = payload
    },
    setHomeAddress(state,payload){
        state.homeAddress = payload
    },
    setOtherAddresses(state, payload){
        state.otherAddresses = payload
    },
    selectAddress(state, payload){

        console.log('payload', payload)
        
        let id = payload.address.id
        let delivery_time = payload.delivery_time
        console.log('id', id)

        let addressInOtherAddressIndex = state.otherAddresses.findIndex(item => item.id === id)
        console.log('addressInOtherAddressIndex', addressInOtherAddressIndex)
        let address = state.otherAddresses[addressInOtherAddressIndex]
        console.log('address', address)

        state.deliveryAddress = address
        state.deliveryAddress.delivery_time = delivery_time

    },
    setDeliveryAddress(state, payload){
        state.deliveryAddress = payload
    },
    updateDeliveryAddress(state, payload){
        state.deliveryAddress.name = payload.name
        state.deliveryAddress.kana = payload.kana
        state.deliveryAddress.zipcode = payload.zipcode
        state.deliveryAddress.prefecture = payload.prefecture
        state.deliveryAddress.city = payload.city
        state.deliveryAddress.address_1 = payload.address_1
        state.deliveryAddress.building = payload.building
        state.deliveryAddress.phone = payload.phone
        state.deliveryAddress.delivery_time = payload.delivery_time
    },
    updateDeliveryName(state,payload){
        state.deliveryAddress.name = payload
    },
    updateDeliveryKana(state,payload){
        state.deliveryAddress.kana = payload
    },
    updateDeliveryZipcode(state,payload){
        state.deliveryAddress.zipcode = payload
    },
    updateDeliveryPrefecture(state,payload){
        state.deliveryAddress.prefecture = payload
    },
    updateDeliveryCity(state,payload){
        state.deliveryAddress.city = payload
    },
    updateDeliveryAddress1(state,payload){
        state.deliveryAddress.address_1 = payload
    },
    updateDeliveryBuilding(state,payload){
        state.deliveryAddress.building = payload
    },
    updateDeliveryPhone(state,payload){
        state.deliveryAddress.phone = payload
    },
    setDeliveryTime(state, payload){
        state.deliveryAddress.delivery_time = payload
    },
    setPostage(state, payload){
        state.deliveryAddress.postage = payload
    },
    setGuest(state, payload){
        state.guest = payload
    },
    clearGuest(state, payload){
        state.guest = payload
    },
    updateGuest(state, payload){
        state.guest = payload
    },
    updateGuestName(state, payload){
        state.guest.name = payload
    },
    updateGuestKana(state, payload){
        state.guest.kana = payload
    },
    updateGuestZipcode(state, payload){
        state.guest.zipcode = payload
    },
    updateGuestPrefecture(state, payload){
        state.guest.prefecture = payload
    },
    updateGuestCity(state, payload){
        state.guest.city = payload
    },
    updateGuestAddress1(state, payload){
        state.guest.address_1 = payload
    },
    updateGuestBuilding(state, payload){
        state.guest.building = payload
    },
    updateGuestPhone(state, payload){
        state.guest.phone = payload
    },
    updateGuestEmail(state, payload){
        state.guest.email = payload
    },
    setProducts(state, payload){
        state.products = payload
        console.log('setProducts')
        console.log(payload);
    },
    setProduct(state, payload){
        state.product = payload
        console.log('setProduct', payload);
    }, 
    setCategories(state, payload){
        state.categories = payload
    },
    setInventoryQuantity(state, payload){
        state.inventoryQuantity = payload
    },
    // setItemGroup(state, payload){
    //     state.itemGroup = payload
    // },
    setFirstItem(state, payload){
        state.firstItem = payload
    },
    setSelectableNumbers(state, payload){

        let quantity = payload

        if(quantity <= 5){
            state.selectableNumbers = [1]
        
        }else{
            state.selectableNumbers = [1, 2, 3, 4, 5]
        }

    },
    // disableSelectAmount(state, payload){
    //     state.disableSelectAmount = payload
    // },
    addToCart(state, payload){

        let product = payload.cartItem
        let newQuantity = payload.cartQuantity

        console.log('newQuantity', newQuantity)
        console.log('slug', product.slug)

        let productInCartIndex = state.cart.findIndex(item => item.slug === product.slug);
        if(productInCartIndex !== -1){
            let originalQuantity = state.cart[productInCartIndex].quantity
            state.cart[productInCartIndex].quantity = Number(originalQuantity) + newQuantity
            // state.cart[productInCartIndex].quantity++;
            state.cart = JSON.parse(JSON.stringify(state.cart));
            //return;
        }else{
            product.quantity = newQuantity;
            state.cart.push(product);
        }

        // state.disableSelectAmount = false;

        console.log('cart',state.cart);
    },
    addOneToCart(state, payload){

        let product = payload.cartItem
        let newQuantity = payload.cartQuantity

        console.log('newQuantity', newQuantity)
        console.log('slug', product.slug)

        let productInCartIndex = state.cart.findIndex(item => item.slug === product.slug);
        if(productInCartIndex !== -1){
            //let originalQuantity = state.cart[productInCartIndex].quantity
            //state.cart[productInCartIndex].quantity = Number(originalQuantity) + newQuantity
            // state.cart[productInCartIndex].quantity++;
            state.cartMessage = "カートにすでに商品が入っております。この商品は一度のご注文につき、1点までのご購入となります。"
            return;
        }else{
            product.quantity = newQuantity;
            state.cart.push(product);
        }

        // state.disableSelectAmount = false;

        console.log('cart',state.cart);
    },
    setProductQuantity(state, payload){
        state.productQuantity = payload;
    },
    updateCartQuantity(state, payload){

        let id = payload.index
        let quantity = payload.value

        console.log('id', id)
        console.log('quantity', quantity)

        state.cart[id].quantity = quantity
        state.cart = JSON.parse(JSON.stringify(state.cart));

        console.log("updateCartQuantity", state.cart[id]);

    },
    removeProduct(state, payload){

        let slug = payload.slug
        console.log('removeProduct', slug)

        let productInCartIndex = state.cart.findIndex(item => item.slug === slug);
        console.log('productInCard', productInCartIndex);
        
        state.cart.splice(productInCartIndex, 1);

        if(state.cartMessage !== null){
            state.cartMessage = null
        }

        console.log(state.cart);

    },
    // setPostage(state, payload){
    //     state.postage = payload
    // },
    updateOrder(state, order) {
        state.order = order;
    },
    updateCart(state, cart) {
        state.cart = cart;
    },
    setOrders(state, payload){
        state.orders = payload
    },
    setOrder(state, payload){
        state.order = payload
    },
    setOrderedProducts(state, payload){
        state.orderedProducts = payload
    },
    setPostages(state, payload){
        state.postages = payload
    },
    setPlannedShipmentDate(state, payload){
        // console.log('payload', payload)
        state.plannedShipmentDate = payload
    },
    setActualShipmentDate(state, payload){
        // console.log('payload', payload)
        state.actualShipmentDate = payload
    },
    setDeliveredDate(state, payload){
        state.deliveredDate = payload
    },
    isAddingAddress(state, payload){
        state.isAddingAddress = payload
    },
    setLoading(state, payload){
        state.loading = payload
    },
    setDialog(state, payload){
        state.dialog = payload
    },
    setDialogThankYou(state, payload){
        state.dialogThankYou = payload
    },
    setDialogThankYouGuest(state, payload){
        state.dialogThankYouGuest = payload
    },
    setDialogEditAddress(state, payload){
        state.dialogEditAddress = payload
    },
    setDialogNewAddress(state, payload){
        state.dialogNewAddress = payload
    },
    setDialogRemoveAddress(state, payload){
        state.dialogRemoveAddress = payload
    },
    setDialogRegisterToOrder(state, payload){
        state.dialogRegisterToOrder = payload
    },
    setDialogLinkSent(state, payload){
        state.dialogLinkSent = payload
    },
    setDisabled(state, payload){
        state.disabled = payload
    },
    updateDisableContinue1(state, payload){
        state.disableContinue1 = payload
    },
    setDisableInputEmail(state, payload){
        state.disableInputEmail = payload
    },
    setallErrors(state, payload){
        state.allerror = payload
    },
    setallRegisterErrors(state, payload){
        state.allRegisterError = payload
    },
    setallLoginErrors(state, payload){
        state.allLoginError = payload
    },
    setCheckoutErrorMessage(state, payload){
        state.checkoutError = payload
    },
    setErrorMessage(state, payload){
        state.errorMessage = payload.message

        console.log(state.errorMessage)
    },
    setCheckoutSnackbar(state, payload){
        state.checkoutSnackbar = payload
    },
    setLinkSentSnackbar(state, payload){
        state.linkSentSnackbar = payload
    },
    setLastPage(state, payload){
        state.lastPage = payload
    },
    setIsEditingName(state, payload){
        state.isEditingName = payload
    },
    setIsEditingEmail(state, payload){
        state.isEditingEmail = payload
    },
    setIsEditingPassword(state, payload){
        state.isEditingPassword = payload
    },
    setIsEditingAddress(state, payload){
        state.isEditingAddress = payload
    },
    setIsEditingDeliveryTime(state, payload){
        state.isEditingDeliveryTime = payload
    },
    
  },
  
  // ゲッター
  getters: {
    
  },
  
  // アクション
  actions: {
    async registerToOrder({state, commit}, payload){

        let allerror = [];
        let user = {};

        commit("setLoading", true);

        await axios
            .post(payload.url, {
                user_type_id: payload.user_type,
                name: payload.name,
                kana: payload.kana,
                zipcode: payload.zipcode,
                prefecture: payload.prefecture,
                city: payload.city,
                address_1: payload.address_1,
                building: payload.building,
                phone: payload.phone,
                email: payload.email,
                password: payload.password,
                password_confirmation: payload.password_confirmation,
            })
            .then(response => {
                // console.log(response);
                user = response.data.user;
                // commit('clearGuest', {});
                commit('setUser', user);
                commit('setLoading', false);
                commit('setDialogRegisterToOrder', false);
                // router.push({path: '/'});
                window.location = '/member/order'
            })
            .catch(error => {
                allerror = error.response.data.errors
                commit('setallRegisterErrors', allerror)
            })
    },
    async register({state, commit}, payload){

        let allerror = [];
        let user = {};

        // commit("setLoading", true);

        await axios
            .post(payload.url, {
                user_type_id: payload.user_type,
                name: payload.name,
                kana: payload.kana,
                zipcode: payload.zipcode,
                prefecture: payload.prefecture,
                city: payload.city,
                address_1: payload.address_1,
                building: payload.building,
                phone: payload.phone,
                email: payload.email,
                password: payload.password,
                password_confirmation: payload.password_confirmation,
            })
            .then(response => {
                // console.log(response);
                user = response.data.user;
                // commit('clearGuest', {});
                commit('setUser', user);
                commit('setLoading', false);
                window.location = '/'
                // router.push({path: '/'});
            })
            .catch(error => {
                allerror = error.response.data.errors
                commit('setallRegisterErrors', allerror)
            })
    },
    async login({commit}, payload){

        // commit('setLoading', true)

        let allerror = [];

        await axios
            .post(payload.url, {
                email: payload.email,
                password: payload.password,
            })
            .then(response => {
                // console.log(response);
                // router.push({path: '/student/main'});
                commit('setLoading', false);
                window.location = "/"
            })
            .catch(error => {
                allerror = error.response.data.errors,
                commit('setallLoginErrors', allerror)
                commit('setLoading', false);
            })
    },
    async loginToCheckout({commit}, payload){

        let allerror = [];

        await axios
            .post(payload.url, {
                email: payload.email,
                password: payload.password,
            })
            .then(response => {
                // console.log(response);
                // router.push({path: '/student/main'});
                window.location = "/member/order"
                commit('setLoading', false);
            })
            .catch(error => {
                allerror = error.response.data.errors,
                commit('setallLoginErrors', allerror)
                commit('setLoading', false);
            })
    },
    async fetchUser({ commit }){
        let payload = {};

        await axios
            .get("/fetch-user")
            .then(res => {
                payload = res.data.user;
                commit('setUser', payload);
                // commit('setDeliveryAddress', payload);
        });
    },
    async guestRegister({state, commit}, payload){

        let allerror = [];
        let user = {};

        commit("setLoading", true);

        await axios
            .post(payload.url, {
                user_type_id: payload.user_type,
                name: payload.name,
                kana: payload.kana,
                zipcode: payload.zipcode,
                prefecture: payload.prefecture,
                city: payload.city,
                address_1: payload.address_1,
                building: payload.building,
                phone: payload.phone,
                email: payload.email,
                password: payload.password,
                password_confirmation: payload.password_confirmation,
            })
            .then(response => {
                // console.log(response);
                user = response.data.user;
                // commit('clearGuest', {});
                commit('setUser', user);
                commit('setLoading', false);
                // router.push({path: '/'});
                window.location = '/'
            })
            .catch(error => {
                allerror = error.response.data.errors
                // commit('setLoading', false);
                // commit('setDisabled', true);
                commit('setallRegisterErrors', allerror)
            })
    },
    async fetchCategories({ commit }){
        let categories = [];
        // let products = [];

        await axios
            .get("/fetch-categories")
            .then(res => {
                categories = res.data.categories;
                // products = res.data.products;
                // commit('setProducts', products);
                commit('setCategories', categories);
        });
    },
    async fetchProducts({ commit }){
        let payload = [];

        await axios
            .get("/fetch-products")
            .then(res => {
                payload = res.data.products;
                commit('setProducts', payload)
                console.log(payload);
        });
    },
    async fetchProduct({commit}, payload){

        console.log('payload', payload)
        
        let product = {};
        let inventory = '';
        let firstItem = {};

        await axios
            .get("/fetch-product/" + payload.id)
            .then(res => {
                product = res.data.product;
                inventory = res.data.inventory;
                firstItem = res.data.item;
                commit('setProduct', product)
                //commit('setSelectableNumbers', inventory)
                commit('setFirstItem', firstItem)
            })
    },
    async fetchInventory({commit}, payload){

        let product_id = payload.product_id;
        console.log('product_id', product_id)
        let inventory = "";

        await axios
        .get("/fetch-inventory/" + product_id)
        .then(res => {
            inventory = res.data.inventory;
            // commit('setInventoryQuantity', quantity)
            commit('setSelectableNumbers', inventory)
            console.log(payload);
    });

    },
    clearCart({commit}) {
        commit('updateCart', []);
    },
    async sendGuestOrderNotify({commit}, payload) {

        console.log('notify', payload);

        await axios
            .post("/guest/order-confirmation", {
                order: payload
            })
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                allerror = error.response.data.errors
                commit('setallErrors', allerror)
            })
    },
    async sendOrderNotify({commit}, payload) {

        console.log('notify', payload);

        await axios
            .post("/member/order-confirmation", {
                order: payload
            })
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                allerror = error.response.data.errors
                commit('setallErrors', allerror)
            })
    },
    removeProduct({commit}, payload) {

        console.log('payload', payload)

        commit('removeProduct', payload);

    },
   
    async addGuest({commit}, payload){

        // commit('setLoading', true);
        
        let deliveryAddress = {};
        let guest = {};
        let postage = "";
        let allerror = [];

        await axios
        .post("/guest/add", {
            name: payload.name,
            kana: payload.kana,
            zipcode: payload.zipcode,
            prefecture: payload.prefecture,
            city: payload.city,
            address_1: payload.address_1,
            building: payload.building,
            phone: payload.phone,
            email: payload.email,
            delivery_time: payload.delivery_time
        })
        .then(res => {
            console.log(res)
            guest = res.data.guest;
            deliveryAddress = res.data.deliveryAddress
            postage = res.data.postage
            commit('setGuest', guest);
            commit('updateDeliveryAddress', guest);
            commit('setPostage', postage);
            commit('setDisabled', true);
            commit('updateDisableContinue1', false);
            // commit('setLoading', false);
        })
        .catch(error => {
            commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },
    async addGuestAndOtherAddress({commit}, payload){

        // commit('setLoading', true);

        let deliveryAddress = payload.deliveryAddress;
        let guest = {};
        let postage = "";
        let allerror = [];

        await axios
        .post("/guest/add-otheraddress", {
            deliveryPrefecture: payload.deliveryPrefecture,
            name: payload.name,
            kana: payload.kana,
            zipcode: payload.zipcode,
            prefecture: payload.prefecture,
            city: payload.city,
            address_1: payload.address_1,
            building: payload.building,
            phone: payload.phone,
            email: payload.email,
        })
        .then(res => {
            console.log(res)
            guest = res.data.guest;
            postage = res.data.postage;
            commit('setGuest', guest);
            commit('setDeliveryAddress', deliveryAddress);
            commit('setPostage', postage);
            commit('setDisabled', true);
            commit('updateDisableContinue1', false);
            // commit('setLoading', false);
            // router.push({ name: 'guestOrder-confirmation'});
        })
        .catch(error => {
            commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },
   
    async setPostage({commit}){

        let allerror = [];
        let postage = "";

        await axios
        .get("/fetch-postage")
        .then(res => {
            postage = res.data.postage;
            console.log('postage', postage)
            commit('setPostage', postage);
            // commit('setDisabled', true);
            // commit('updateDisableContinue1', false);
            // commit('setLoading', false);
            // router.push({ name: 'order-confirmation'});
        })
        .catch(error => {
            // commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })
    },
    async setDeliveryAddress({commit}, payload){

        commit('updateDeliveryAddress', payload);
        commit('setDisabled', true);
        commit('updateDisableContinue1', false);
        
        // let allerror = [];
        // let postage = "";

        // await axios
        // .get("/fetch-postage")
        // .then(res => {
        //     console.log(res)
        //     postage = res.data.postage;
        //     commit('setPostage', postage);
        //     commit('setDisabled', true);
        //     commit('updateDisableContinue1', false);
        //     // commit('setLoading', false);
        //     // router.push({ name: 'order-confirmation'});
        // })
        // .catch(error => {
        //     commit('setLoading', false);
        //     allerror = error.response.data.errors,
        //     commit('setallErrors', allerror)
        // })

    },

    async updateAddress({commit}, payload){
        
        let allerror = [];
        let user = {};

        await axios
        .post("/update-address", {
            // name: payload.name,
            // kana: payload.kana,
            zipcode: payload.zipcode,
            prefecture: payload.prefecture,
            city: payload.city,
            address_1: payload.address_1,
            building: payload.building,
            phone: payload.phone,
        })
        .then(res => {
            user = res.data.user;
            commit('updateUser', user);
            commit('setDialogEditAddress', false);
            // commit('setLoading', false);
            // router.push({path: '/check-address'});
        })
        .catch(error => {
            commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },

    async addOtherAddress({commit}, payload){
        
        let allerror = [];
        let deliveryAddress = {};
        let otherAddresses = [];

        await axios
        .post("/other-address", {
            name: payload.name,
            kana: payload.kana,
            zipcode: payload.zipcode,
            prefecture: payload.prefecture,
            city: payload.city,
            address_1: payload.address_1,
            building: payload.building,
            phone: payload.phone,
        })
        .then(res => {
            deliveryAddress = res.data.deliveryAddress;
            otherAddresses = res.data.otherAddresses;
            commit('setDeliveryAddress', deliveryAddress);
            commit('setOtherAddresses', otherAddresses)
            commit('setDialogNewAddress', false);
            // commit('setLoading', false);
            // router.push({path: '/order-confirmation'});
        })
        .catch(error => {
            // commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },
    async fetchOtherAddresses({commit}){

        let payload = [];

        await axios
        .get("/collect-address")
        .then(res => {
            payload = res.data.addresses;
            console.log('result', payload)
            commit('setOtherAddresses', payload);
            // commit('setDeliveryAddress', payload);
        })
        .catch(error => {
            // commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })
        
    },
    selectAddress({commit}, payload){

        commit('selectAddress', payload);
        commit('setDisabled', true);
        commit('updateDisableContinue1', false);
        // router.push({ name: 'order-confirmation'});
    },
    async removeAddress({commit}, payload){

        let otherAddresses = [];
        console.log('payload', payload.id)

        await axios
        .post("/remove-address", {
            id: payload.id
        })
        .then(res => {
            otherAddresses = res.data.otherAddresses;
            commit('setOtherAddresses', otherAddresses);
            commit('setDialogRemoveAddress', false)
            // commit('setDeliveryAddress', payload);
        })
        .catch(error => {
            // commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },
    async fetchOrders({commit}, payload){

        console.log('page', payload.pageNumber);

        let orders= {};
        let lastPage = "";

        await axios
        .get("/order-summary", {
            params: {
                page: parseInt(payload.pageNumber)
            }
        })
        .then(res => {
            orders = res.data.orders.data;
            lastPage = res.data.orders.last_page;
            console.log('lastPage', lastPage)
            console.log('orders', orders)
            commit('setOrders', orders);
            commit('setLastPage', lastPage);
            // commit('setDeliveryAddress', payload);
        })
        .catch(error => {
            // commit('setLoading', false);
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })
    },
   
    showDialog({commit}){
        commit('setDialog', true);
    },
    showDialogThankYou({commit}){
        commit('setDialogThankYou', true);
    },
    showDialogThankYouGuest({commit}){
        commit('setDialogThankYouGuest', true);
    },
    dialogEditAddress({commit}, payload){
        commit('setDialogEditAddress', payload);
    },
    dialogNewAddress({commit}, payload){
        commit('setDialogNewAddress', payload);
    },
    dialogRemoveAddress({commit}, payload){

        commit('setDialogRemoveAddress', payload);

    },
    clearGuest({commit}) {
        commit('updateGuest', {});
    },
    clearDeliveryAddress({commit}) {
        commit('updateDeliveryAddress', {});
    },
    addToCart({commit}, payload){


       commit('addToCart', payload);

    },

    //order details
    async fetchOrder({state, commit}, payload){

        console.log('id', payload.id);

        let order = {};
        let products = [];

        await axios
            .get('/member/fetch-order/' + payload.id)
            .then(response => {
                order = response.data.order;
                products = response.data.products;
                commit('setOrder', order);
                commit('setOrderedProducts', products);
            })
            .catch(error => {
                allerror = error.response.data.errors,
                commit('setallErrors', allerror)
            })
    },
    async fetchShipment({state, commit}, payload){

        let scheduled_date = "";
        let actual_date = "";
        let delivered_date = "";

        await axios
            .get('/member/fetch-shipment/' + payload.id)
            .then(response => {
                scheduled_date = response.data.scheduled_date;
                actual_date = response.data.actual_date;
                delivered_date = response.data.delivered_date
                commit('setPlannedShipmentDate', scheduled_date);
                commit('setActualShipmentDate', actual_date);
                commit('setDeliveredDate', delivered_date);
            })
            .catch(error => {
                allerror = error.response.data.errors,
                commit('setallErrors', allerror)
            })
    },

    //reset password
     async sendResetLink({state, commit}, payload){

        let errorMessage = {};

        await axios
            .post(payload.url, {
                email: payload.email,
            })
            .then(response => {
                console.log('res', response)
                // commit('setLinkSentSnackbar', true);
                commit('setLoading', false);
                // commit('setLinkSentSnackbar', true);
                commit('setDialogLinkSent', true);
                commit('setDisabled', true);
            })
            .catch(error => {
                errorMessage = error.response.data.error;
                console.log(errorMessage);
                commit('setErrorMessage', errorMessage);
                commit('setLoading', false);
                commit('setDisableInputEmail', false);
                commit('setDisabled', true);
            })
    },
    async resetPassword({state, commit}, payload){

        console.log(payload);
    
        let errorMessage = "";

        await axios
            .post('/password/reset', {
                token: payload.token,
                email: payload.email,
                password: payload.password,
                password_confirmation: payload.password_confirmation
            })
            .then(response => {
                console.log('res', response)
                // commit('setLinkSentSnackbar', true);
                commit('setLoading', false);
                // commit('setLinkSentSnackbar', true);
                // commit('setDisabled', true);
                window.location = "/"
            })
            .catch(error => {
                errorMessage = error.response.data.error;
                console.log(errorMessage);
                commit('setErrorMessage', errorMessage);
                commit('setLoading', false);
                // commit('setDisableInputEmail', false);
                // commit('setDisabled', true);
            })
    },
    async fetchPostages({ commit }){
        let payload = {};

        await axios
            .get("/fetch-postages")
            .then(res => {
                payload = res.data.postages;
                commit('setPostages', payload);
                // commit('setDeliveryAddress', payload);
        });
    },
    async updateUserName({state, commit}, payload){
    
        let allerror = [];
        let name = "";

        await axios
            .post('/member/update-name', {
                id: payload.id,
                name: payload.name
            })
            .then(response => {
                name = response.data.name;
                kana = response.data.kana;
                commit('updateUserName', name)
                commit('updateUserKana', kana)
                commit('setIsEditingName', false);
            })
            .catch(error => {
                allerror = error.response.data.errors;
                commit('setallErrors', allerror);
            })
    },
    async updateUserAddress({commit}, payload){
        
        let allerror = [];
        let user = {};

        await axios
        .post("/update-address", {
            // name: payload.name,
            // kana: payload.kana,
            zipcode: payload.zipcode,
            prefecture: payload.prefecture,
            city: payload.city,
            address_1: payload.address_1,
            building: payload.building,
            phone: payload.phone,
        })
        .then(res => {
            user = res.data.user;
            commit('updateUser', user);
            commit('setIsEditingAddress', false);
            // commit('setLoading', false);
            // router.push({path: '/check-address'});
        })
        .catch(error => {
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },
    async updateUserEmail({commit}, payload){
        
        let allerror = [];
        let email ="";

        await axios
        .post("/member/update-email", {
            // name: payload.name,
            // kana: payload.kana,
            email: payload.email,
        })
        .then(res => {
            email = res.data.email;
            commit('updateUserEmail', email);
            commit('setIsEditingEmail', false);
            // commit('setLoading', false);
            // router.push({path: '/check-address'});
        })
        .catch(error => {
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },
    async updateUserPassword({commit}, payload){
        
        let allerror = [];
        let user = {};

        await axios
        .post("/member/update-password", {
            // name: payload.name,
            // kana: payload.kana,
            password: payload.password,
            password_confirmation: payload.password_confirmation

        })
        .then(res => {
            user = res.data.user;
            commit('updateUser', user);
            commit('setIsEditingPassword', false);
            // commit('setLoading', false);
            // router.push({path: '/check-address'});
        })
        .catch(error => {
            allerror = error.response.data.errors,
            commit('setallErrors', allerror)
        })

    },

  },
  modules: {
    admin,
  }

})
