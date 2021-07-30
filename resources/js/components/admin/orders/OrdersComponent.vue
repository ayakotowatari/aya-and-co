<template>
    <div>
        <shipmentschedule-component
            v-bind:dialogShipment="dialogShipment"
            v-bind:order="order"
        ></shipmentschedule-component>
        <updateshipmentschedule-component
            v-bind:dialogUpdateShipment="dialogUpdateShipment"
            v-bind:order="order"
        ></updateshipmentschedule-component>
        <updatestatusdialog-component
            v-bind:dialogUpdateStatus="dialogUpdateStatus"
            v-bind:order="order"
        ></updatestatusdialog-component>
        <eachorder-component></eachorder-component>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            
        }
    },
    mounted(){
        this.$store.dispatch('admin/fetchOrder', {
            id: this.id
        });
      
    },
    created(){
     
    },
    computed: {
         ...mapState('admin', [
            'order',
            'dialogShipment',
            'dialogUpdateShipment',
            'dialogUpdateStatus',
        ]),
    
    },
    methods: {
      

        
    }


}
</script>

<style>

</style>