<template>
    <v-container>
        <div v-for="order in orders" :key="order.id">
            {{order.delivery_zipcode}}
        </div>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            
        }
    },
    mounted(){
        // this.$store.dispatch('admin/fetchOrders')
    },
    created(){
        this.$store.dispatch('admin/fetchOrders')
    },
    computed: {
        ...mapState('admin', [
            'orders',
        ]),
    
    },
    methods: {
      

        
    }


}
</script>

<style>

</style>