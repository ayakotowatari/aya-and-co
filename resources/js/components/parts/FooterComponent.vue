<template>
    <v-footer
        padless
        bottom
        class="text-center"
        color="white"
    >
     
        <v-card-text
            v-for="icon in icons"
            :key="icon.mark">
            <v-btn
                class="mx-4 grey--text text--darken-1"
                icon
                :href="icon.link"
                target="_blank"       
            >
                <v-icon size="48px">
                    {{ icon.mark }}
                </v-icon>
            </v-btn>
        </v-card-text>

        <!-- <v-card-text class="grey--text pt-0">
            Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
        </v-card-text> -->

        <v-divider></v-divider>

        <v-card-text class="grey--text">
            {{ new Date().getFullYear() }} — <strong class="logo">aya & co.</strong>
        </v-card-text>
    </v-footer>
</template>

<script>
export default {
    data: function(){
        return {
            icons: [
                // 'mdi-facebook',
                // 'mdi-twitter',
                // 'mdi-linkedin',
                { mark: 'mdi-instagram', link: 'https://www.instagram.com/ayako.towatari/' },
            ],
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
    
    },
    methods: {
      

        
    }


}
</script>

<style>
.logo{
    font-family: mrs-eaves, serif;
    font-weight: 400;
    font-style: normal;
    font-size: 24px;
}

</style>