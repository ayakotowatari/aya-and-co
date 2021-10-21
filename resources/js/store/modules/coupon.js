import router from "../../router"

export const coupon = {
    namespaced: true,

    state: {
        coupon: {
            name: '',
            type: '',
            value: '',
            percent_off: '',
            applied: false
        },
        couponDisabled: false,
        allError: []
       
    },
    mutations: {
        setCoupon(state, payload){
            state.coupon.name = payload.name
            state.coupon.type = payload.type
            state.coupon.value = payload.value
            state.coupon.percent_off = payload.percent_off
            state.coupon.applied = true
        },
        updateCoupon(state){
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
        }
        
    },
    actions: {
        async applyCoupon({state, commit}, payload){

            let allerror = {};
            let coupon = {};
            // let message = '';
    
            // commit("setLoading", true);
    
            await axios
                .post('/member/coupon', {
                    coupon_code: payload.coupon_code,
                  
                })
                .then(response => {
                    console.log(response);
                    // if(response.data.coupon !== null){
                    //     coupon = response.data.coupon;
                    //     commit('setCoupon', coupon);
                    // }else{
                    //     message = response.data.message
                    //     commit('setCouponErrors', message)
                    // }
                    
                    coupon = response.data.coupon;
                    // message = response.data.message;
                    commit('setCoupon', coupon);
                    commit('setCouponDisabled', true);
                    // commit('setCouponErrors', message)
                    
                    // console.log(response);
                    // console.log('coupon', coupon);
                    // console.log('message', message);
                    // // commit('clearGuest', {});
                    
                    
                    // commit('setLoading', false);
                    // router.push({path: '/'});
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setAllErrors', allerror)
                    commit('setCouponDisabled', true);
                    console.log('error', allerror)
                })
        },
        clearAllErrors({commit}) {
            commit('updateAllErrors', []);
        },
        clearCoupon({commit}){
            commit('updateCoupon');
        }

    }

}