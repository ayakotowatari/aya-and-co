import router from "../../router2"

export const admin = {
    namespaced: true,

    state: {
       user: {},
       orders: [],
       order: {},
       shipment: {},
       plannedShipmentDate: null,
       actualShipmentDate: null,
       deliveredDate: null,
       shipmentOrders: [],
       orderStatus: '',
       orderedProducts: [],
       categories:[],
       category: {
           name: '',
           subtitle: '',
           details: '',
           description: '',
           season: '',
           ingredients: '',
           image: '',
           absolute_path:'',
           status: '',
       },
       products: [],
       product: {},
       dialogShipment: false,
       dialogUpdateShipment: false,
       dialogUpdateStatus: false,
       statuses: [],
       categoryStatuses: [],
       showEditSubtitle: false,
       showEditDetails: false,
       showEditDescription: false,
       showEditSeason: false,
       showEditIngredients: false,
       showEditImage: false,
       showUpdateInventory: false,
       showUpdateTotal: false,
       showUpdateCategoryStatus: false,
       showUpdateProductStatus: false,
       loading: false,
       allerror: [],
       allLoginError: [],
       allRegisterError: [],
    },
    mutations: {
        setUser(state, payload){
            state.user = payload
        },
        setOrders(state, payload){
            state.orders = payload
        },
        setOrder(state, payload){
            console.log('setOrder')
            console.log(payload)
            state.order = payload
            state.orderStatus = payload.status
        },
        setShipment(state, payload){
            state.shipment = payload
        },
        setShipmentOrders(state, payload){
            state.shipmentOrders = payload
            console.log('orders')
        },
        setOrderedProducts(state, payload){
            state.orderedProducts = payload
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
        setCategories(state, payload){
            state.categories = payload
        },
        setCategory(state, payload){
            state.category = payload
        },
        setCategoryImage(state, payload){
            state.category.image = payload;
        },
        setProducts(state, payload){
            state.products = payload
        },
        setProduct(state, payload){
            state.product = payload
        },
        setallError(state, payload){
            state.allerror = payload
        },
        dialogShipment(state, payload){
            state.dialogShipment = payload
        },
        dialogUpdateShipment(state, payload){
            state.dialogUpdateShipment = payload
        },
        dialogUpdateStatus(state, payload){
            state.dialogUpdateStatus = payload
        },
        setStatuses(state, payload){
            state.statuses = payload
        },
        setCategoryStatuses(state, payload){
            state.categoryStatuses = payload
        },
        setCategoryStatus(state, payload){
            state.category.status = payload
        },
        setProductStatus(state, payload){
            state.product.status = payload
        },
        updateOrderStatus(state, payload){
            state.orderStatus = payload
        },
        setShowEditSubtitle(state, payload){
            state.showEditSubtitle = payload
        },
        setCategorySubtitle(state, payload){
            state.category.subtitle = payload
        },
        setShowEditDetails(state, payload){
            state.showEditDetails = payload
        },
        setCategoryDetails(state, payload){
            state.category.details = payload
        },
        setShowEditDescription(state, payload){
            state.showEditDescription= payload
        },
        setCategoryDescription(state, payload){
            state.category.description = payload
        },
        setShowEditSeason(state, payload){
            state.showEditSeason= payload
        },
        setCategorySeason(state, payload){
            state.category.season = payload
        },
        setShowEditIngredients(state, payload){
            state.showEditIngredients= payload
        },
        setCategoryIngredients(state, payload){
            state.category.ingredients = payload
        },
        setShowEditImage(state, payload){
            state.showEditImage= payload
        },
        setCategoryIngredients(state, payload){
            state.category.image = payload
        },
        setShowUpdateInventory(state, payload){
            state.showUpdateInventory = payload
        },
        setShowUpdateCategoryStatus(state, payload){
            state.showUpdateCategoryStatus = payload
        },
        setShowUpdateProductStatus(state, payload){
            state.showUpdateProductStatus = payload
        },
        setInventory(state, payload){
            state.product.inventory = payload
        },
        setTotal(state, payload){
            state.product.total = payload
        },
        setLoading(state, payload){
            state.loading = payload
        },
        setAllErrors(state, payload){
            state.allerror = payload
        },
        setAllLoginErrors(state, payload){
            state.allLoginError = payload
        },
        setAllRegisterErrors(state, payload){
            state.allRegisterError = payload
        }
    },
    actions: {
        async register({state, commit}, payload){

            let allerror = [];
            let user = [];
    
            // commit("setLoading", true);
    
            await axios
                .post(payload.url, {
                    user_type_id: payload.user_type,
                    name: payload.name,
                    email: payload.email,
                    password: payload.password,
                    password_confirmation: payload.password_confirmation,
                })
                .then(response => {
                    // console.log(response);
                    user = response.data.user;
                    // commit('clearGuest', {});
                    commit('setUser', user);
                    // commit('setLoading', false);
                    // router.push({path: '/'});
                    window.location = '/admin/orders-list'
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setAllRegisterErrors', allerror)
                })
        },
        async login({commit}, payload){

            // commit('setLoading', true)
            
            let user = {};
            let allerror = [];
    
            await axios
                .post(payload.url, {
                    email: payload.email,
                    password: payload.password,
                })
                .then(response => {
                    console.log(response);
                    // router.push({path: '/student/main'});
                    // commit('setLoading', false);
                    user = response.data.user
                    commit('setUser', user)
                    window.location = "/admin/orders-list"
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setAllLoginErrors', allerror)
                })
        },
        async fetchUser({ commit }){
            let payload = {};
    
            await axios
                .get("/admin/user")
                .then(res => {
                    payload = res.data.user;
                    commit('setUser', payload);
                    // commit('setDeliveryAddress', payload);
                })

        },
        async fetchOrders({state, commit}, payload){

            let orders = [];

            await axios
                .get('/fetch-orders')
                .then(response => {
                    orders = response.data.orders;
                    commit('setOrders', orders)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchOrder({state, commit}, payload){

            console.log(payload.id);

            let order = {};
            let products = [];

            await axios
                .get('/fetch-order/' + payload.id)
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
                .get('/fetch-shipment/' + payload.id)
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
        async fetchShipmentOrders({state, commit}){

            let orders = [];

            await axios
                .get('/orders-shipment')
                .then(response => {
                    orders = response.data.orders;
                    commit('setShipmentOrders', orders);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async scheduleShipment({state, commit}, payload){

            let date= "";
            let allerror = [];

            console.log('date', payload.date);

            await axios
                .post('/schedule-shipment', {
                    id: payload.id,
                    date: payload.date,
                    delivery_time: payload.delivery_time,
                    postage: payload.postage
                })
                .then(res => {
                    date = res.data.date
                    console.log('res', date)
                    commit('setPlannedShipmentDate', date)
                    commit('dialogShipment', false)
                    // commit('setLoading', false);
                    // router.push({path: '/check-address'});
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateScheduleShipment({state, commit}, payload){

            let date= ""
            let allerror = [];

            console.log('date', payload.date);

            await axios
                .post('/update-shipment', {
                    id: payload.id,
                    date: payload.date,
                })
                .then(res => {
                    date = res.data.date
                    commit('setPlannedShipmentDate', date)
                    commit('dialogUpdateShipment', false)
                    // commit('setLoading', false);
                    // router.push({path: '/check-address'});
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchStatuses({state, commit}){

            let statuses = [];
            let allerror = [];

            await axios
                .get('/fetch-statuses')
                .then(response => {
                    statuses = response.data.statuses;
                    commit('setStatuses', statuses);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateStatus({state, commit}, payload){

            let status = ""
            let allerror = [];

            await axios
                .post('/update-status', {
                    id: payload.id,
                    status_id: payload.status_id,
                })
                .then(res => {
                    status = res.data.status
                    commit('updateOrderStatus', status)
                    commit('dialogUpdateStatus', false)
                    // commit('setLoading', false);
                    // router.push({path: '/check-address'});
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchCategories({commit}){

            let categories = [];

            await axios
                .get('/admin/fetch-categories')
                .then(response => {
                    categories = response.data.categories;
                    commit('setCategories', categories)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchCategory({state, commit}, payload){

            let category = {};
            let allerror = [];

            await axios
                .get('/admin/fetch-category/' + payload.id)
                .then(response => {
                    category = response.data.category;
                    commit('setCategory', category)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async editSubtitle({state, commit}, payload){

            console.log('payload', payload)

            let newSubtitle = "";
            let allerror = [];

            await axios
                .post('/admin/edit-subtitle', {
                    id: payload.id,
                    subtitle: payload.subtitle
                })
                .then(response => {
                    newSubtitle = response.data.subtitle;
                    commit('setCategorySubtitle', newSubtitle);
                    commit('setShowEditSubtitle', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async editDetails({state, commit}, payload){

            console.log('payload', payload)

            let newDetails = "";
            let allerror = [];

            await axios
                .post('/admin/edit-details', {
                    id: payload.id,
                    details: payload.details
                })
                .then(response => {
                    newDetails = response.data.details;
                    commit('setCategoryDetails', newDetails);
                    commit('setShowEditDetails', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async editDescription({state, commit}, payload){

            console.log('payload', payload)

            let newDescription = "";
            let allerror = [];

            await axios
                .post('/admin/edit-description', {
                    id: payload.id,
                    description: payload.description
                })
                .then(response => {
                    newDescription = response.data.description;
                    commit('setCategoryDescription', newDescription);
                    commit('setShowEditDescription', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async editSeason({state, commit}, payload){

            console.log('payload', payload)

            let newSeason = "";
            let allerror = [];

            await axios
                .post('/admin/edit-season', {
                    id: payload.id,
                    season: payload.season
                })
                .then(response => {
                    newSeason = response.data.season;
                    commit('setCategorySeason', newSeason);
                    commit('setShowEditSeason', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async editIngredients({state, commit}, payload){

            console.log('payload', payload)

            let newIngredients = "";
            let allerror = [];

            await axios
                .post('/admin/edit-ingredients', {
                    id: payload.id,
                    ingredients: payload.ingredients
                })
                .then(response => {
                    newIngredients = response.data.ingredients;
                    commit('setCategoryIngredients', newIngredients);
                    commit('setShowEditIngredients', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async editImage({state, commit}, payload){

            console.log('payload', payload)

            let newImage = "";
            let allerror = [];

            let data = new FormData();
            data.append("image", payload.image);
            data.append("id", payload.id)

            let config = {headers: {'Content-Type': 'multipart/form-data'}};

            await axios
                .post('/admin/edit-image', data, config)
                .then(response => {
                    newImage = response.data.image;
                    commit('setCategoryImage', newImage);
                    commit('setShowEditImage', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },

        async fetchProducts({commit}){

            let products = [];

            await axios
                .get('/admin/fetch-products')
                .then(response => {
                    products = response.data.products;
                    commit('setProducts', products)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },

        async fetchProduct({state, commit}, payload){

            let product = {};
            let total = '';

            await axios
                .get('/admin/fetch-product/' + payload.id)
                .then(response => {
                    product = response.data.product;
                    total = response.data.total;
                    commit('setProduct', product);
                    commit('setTotal', total)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })

        },

        async updateInventory({state, commit}, payload){

            let inventory ="";

            await axios
                .post('/admin/update-inventory', {
                    id: payload.id,
                    inventory: payload.inventory
                })
                .then(response => {
                    inventory = response.data.inventory;
                    commit('setInventory', inventory);
                    commit('setShowUpdateInventory', false);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })

        },
        async createCategory({state, commit}, payload){

            console.log('payload', payload)

            let category = {};

            await axios
                .post('/admin/create-category', {
                    name: payload.name,
                    subtitle: payload.subtitle,
                    details: payload.details,
                    description: payload.description,
                    season: payload.season,
                    ingredients: payload.ingredients,
                    image: payload.image,
                    status_id: payload.status_id
                })
                .then(response => {
                    // category = response.data.category;
                    // commit('setCategory', category);
                    commit('setLoading', false);
                    router.push({path: '/admin/categories-list'});
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchCategoryStatuses({state, commit}){

            let statuses = [];

            await axios
                .get('/admin/fetch-statuses')
                .then(response => {
                    statuses = response.data.statuses;
                    console.log('response', statuses)
                    commit('setCategoryStatuses', statuses);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateCategoryStatus({state, commit}, payload){

            let status = "";

            await axios
                .post('/admin/update-status', {
                    id: payload.id,
                    status_id: payload.status_id
                })
                .then(response => {
                    status = response.data.status;
                    console.log('response', status)
                    commit('setCategoryStatus', status);
                    commit('setShowUpdateCategoryStatus', false)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async createProduct({state, commit}, payload){

            console.log('payload', payload)

            let category = {};

            await axios
                .post('/admin/create-product', {
                    name: payload.name,
                    size: payload.size,
                    slug: payload.slug,
                    price: payload.price,
                    category_id: payload.category_id,
                    inventory: payload.inventory,
                    status_id: payload.status_id,
                })
                .then(response => {
                    // category = response.data.category;
                    // commit('setCategory', category);
                    commit('setLoading', false);
                    router.push({path: '/admin/products-list'});
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateProductStatus({state, commit}, payload){

            let status = "";

            await axios
                .post('/admin/update-productstatus', {
                    id: payload.id,
                    status_id: payload.status_id
                })
                .then(response => {
                    status = response.data.status;
                    console.log('response', status)
                    commit('setProductStatus', status);
                    commit('setShowUpdateProductStatus', false)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        




    }

}