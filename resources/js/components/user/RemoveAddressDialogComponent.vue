<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogRemoveAddress" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        以下の宛先を削除してよろしいですか？
                    </v-card-title>
                    <v-card-text class="ja-font-400">
                        〒{{address.zipcode}} <br>
                        {{address.prefecture}}{{address.city}}{{address.address_1}} <br>
                        {{address.name}}様
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="remove(address)">削除する</v-btn>
                    <v-btn color="grey darken-2" text @click="back">戻る</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialogRemoveAddress: Boolean,
        address: Object,
        user: Object,
    },
    data: function(){
        return {
            
        }
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
        ...mapState([
          
        ])
    },
    methods: {
        ...mapActions([

        ]),
        remove(value){
            console.log('value', value);
            let removedAddress = value
            this.$store.dispatch('removeAddress', removedAddress)
        },
        back(){
            this.$store.dispatch('dialogRemoveAddress', false)
        }
        
    }


}
</script>

<style>
.dialog-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}


</style>