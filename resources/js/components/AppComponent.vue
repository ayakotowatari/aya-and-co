<template>
<v-app>
    <v-main>
        <navbar-component
            v-bind:user='user'
        ></navbar-component>
        <v-container>
            <router-view
                :key="$route.path"
                v-bind:user='user'
                v-bind:deliveryAddress='deliveryAddress'
                class="mb56"
            ></router-view>
        </v-container>
    </v-main>
    <footer-component></footer-component>
</v-app>
</template>

<script>
import { mapState } from 'vuex'

export default {
    data: function(){
        return {

            
        }
    },
    mounted(){
        this.$store.dispatch('fetchUser');
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'user',
            'deliveryAddress',
        ])
    
    },
    methods: {
      
        
    }

}
</script>

<style>
.mb56{
    margin-bottom: 56px;
}

</style>