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
        couponMessage: null, 
        allError: {}
       
    },
    mutations: {
        setCoupon(state, payload){
            state.coupon.name = payload.name
            state.coupon.type = payload.type
            state.coupon.value = payload.value
            state.coupon.percent_off = payload.percent_off
            state.coupon.applied = true
        },
        setCouponMessage(state, payload){
            state.couponMessage = payload
        },
        setAllError(state, payload){
            state.allError = payload
        }
        
    },
    actions: {
        async applyCoupon({state, commit}, payload){

            let allerror = [];
            let coupon = {};
            let message = '';
    
            // commit("setLoading", true);
    
            await axios
                .post('/member/coupon', {
                    coupon_code: payload.coupon_code,
                  
                })
                .then(response => {
                    // console.log(response);
                    coupon = response.data.coupon;
                    message = response.data.message;
                    console.log(response);
                    console.log('coupon', coupon);
                    console.log('message', message);
                    // commit('clearGuest', {});
                    commit('setCoupon', coupon);
                    commit('setCouponMessage', message)
                    // commit('setLoading', false);
                    // router.push({path: '/'});
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setAllErrors', allerror)
                    console.log('error', allerror)
                })
        },
        
        
        




    }

}