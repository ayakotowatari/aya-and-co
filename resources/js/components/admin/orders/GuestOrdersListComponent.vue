<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Guest Orders List
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        ゲスト注文リスト
                    </div>
                </div>
            </v-col>
        </v-row>
      <v-row>
            <v-col cols="12" sm="4" offset-sm="8">
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
            </v-col>
      </v-row>
      <v-data-table
          :headers="headers"
          :items="orders"
          :search="search"
          class="elevation-1 mt-10"
        >
        <template slot="items" slot-scope="myprops">
          <td v-for="header in headers" :key="header.text">
            {{ myprops.item[header.value] }}
          </td>
        </template>
        <!-- <template v-slot:[`item.date`]="{ item }">
          {{ formattedDate(item.date) }}
        </template> -->
        <!-- <template v-slot:[`item.dashboard`]="{ item }">
          <v-icon
            v-show="item.status !== 'Draft'"
            small
            class="mr-4"
            @click="toDashboard(item.id)"
          >
            mdi-open-in-new
          </v-icon>
        </template> -->
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon
            small
            @click="expand(item.id)"
          >
            mdi-open-in-new
          </v-icon>
          <!-- <v-icon
            v-show="item.status == 'Complete'"
            small
            class="mr-4"
            @click="editItem(item)"
          >
            mdi-content-copy
          </v-icon>
          <v-icon
            small
            @click="deleteItem(item)"
          >
            mdi-trash-can-outline
          </v-icon> -->
        </template>
        <template v-slot:[`item.status`]="{ item }">
          <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
        </template>
          <!-- <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Reset</v-btn>
          </template> -->
        </v-data-table>
  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            // dialog: false,
            search:'',
            headers: [
                {
                text: '注文ID',
                align: 'start',
                value: 'id',
                },
                { text: '注文日', value: 'created_at'},
                { text: 'ゲスト氏名', value: 'guest_name'},
                { text: 'Eメール', value: 'guest_email', sortable: false  },
                { text: '電話番号', value: 'guest_phone', sortable: false  },
                { text: '状況', value: 'status'},
                { text: '詳細', value: 'actions', sortable: false },
            ],
            
        }
    },
    // watch: {
    //   dialog (val) {
    //     val || this.close()
    //   },
    // },
    mounted(){
        this.$store.dispatch('admin/fetchGuestOrders')
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'orders',
        ]),
    
    },
    methods: {
        getColor(status){
            if (status == 'Ongoing') return '#67A8DD'
            else if (status == 'Scheduled') return '#85D1BB'
            else if (status == 'Packed') return '#85D1BB'
            else if (status == 'Shipped') return '#F0D117'
            else if (status == 'Delivered') return '#FE6862'
            else if (status == 'Cancelled') return '#F7E3B5'
            else if (status == 'Missing') return '#F7E3B5'
            else if (status == 'Completed') return '#6B21B5'
            else return 'info'
        },
        expand(id){
            console.log(id); 
            this.$router.push({name: 'each-guestorder', params: {id: id}})
        },
        // expand(id){
        //     console.log(id); 
        //     this.$router.push({name: 'admin-orders', params: {id: id}})
        // },
      

        
    }


}
</script>

<style>

</style>