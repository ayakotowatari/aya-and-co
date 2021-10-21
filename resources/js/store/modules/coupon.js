import router from "../../router"

export const coupon = {
    namespaced: true,

    state: {
        coupon: {
            id: '',
            name: '',
            type: '',
            value: '',
            percent_off: '',
            applied: false
        },
        couponDisabled: false,
        allError: {
            coupon: '',
            coupon_code: ''
        },
        otherError: {}
       
    },
    mutations: {
        setCoupon(state, payload){
            state.coupon.id = payload.id
            state.coupon.name = payload.name
            state.coupon.type = payload.type
            state.coupon.value = payload.value
            state.coupon.percent_off = payload.percent_off
            state.coupon.applied = true

        },
        emptyCoupon(state){
            state.coupon.name = ''
            state.coupon.type = ''
            state.coupon.value = ''
            state.coupon.percent_off = ''
            state.coupon.applied = false
        },
        setCouponDisabled(state, payload){
            state.couponDisabled = payload
        },
        setAllErrors(state, payload){
            state.allError = payload
        },
        updateAllErrors(state, payload){
            state.allError = payload
        },
        setOtherErrors(state, payload){
            state.otherError = payload
        }
        
    },

    getters: {

        discount(state, getters, rootState){

            if(state.coupon.type == "fixed"){

                return state.coupon.value

            }else if(state.coupon.type == "percent"){

                let cartAmount = rootState.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                let percentOff = state.coupon.percent_off / 100;
                let discount = cartAmount * percentOff;

                return discount

            }else if(state.coupon.type == "postage"){

                let postage = rootState.deliveryAddress.postage

                return postage

            }else{

                return null
            }

        }

    },
    actions: {
        async applyCoupon({state, commit}, payload){

            let allerror = {};
            let coupon = {};
    
            await axios
                .post('/member/coupon', {
                    coupon_code: payload.coupon_code,
                  
                })
                .then(response => {
                    console.log(response);
                    
                    coupon = response.data.coupon;

                    commit('setCoupon', coupon);
                    commit('setCouponDisabled', true);
                   
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setAllErrors', allerror)
                    commit('setCouponDisabled', true);
                    console.log('error', allerror)
                })
        },
        async storeCouponData({state, commit}, payload){

            let allerror = {};
    
            await axios
                .post('/member/store-coupon', {
                    coupon: payload,
                })
                .then(response => {
                    console.log(response);
                    
                    commit('emptyCoupon');
                   
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setOtherErrors', allerror)
                    console.log('error', allerror)
                })
        },
        clearAllErrors({commit}) {
            commit('updateAllErrors', []);
        },
        clearCoupon({commit}){
            commit('emptyCoupon');
        },


    }

}