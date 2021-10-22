<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Coupons List
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        クーポンリスト
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <v-btn
                    color="primary"
                    outlined
                    @click="$router.push({name: 'create-coupon'})"
                >
                    新規作成
                </v-btn>
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
          :items="coupons"
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
                text: 'クーポンID',
                align: 'start',
                value: 'id',
                },
                { text: '名前', value: 'name'},
                { text: 'タイプ', value: 'type'},
                { text: '値', value: 'value', sortable: false  },
                { text: '割引率', value: 'percent_off', sortable: false  },
                { text: '最小金額', value: 'minimum'},
                { text: '期限', value: 'date_by', sortable: false },
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
        this.$store.dispatch('coupon/fetchCoupons')
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'users',
        ]),
        ...mapState('coupon', [
            'coupons'
        ])
    
    },
    methods: {
        getColor(status){
            if (status == 'Ongoing') return '#67A8DD'
            else if (status == 'Discontinued') return '#6B21B5'
            else return 'info'
        },
        expand(id){
            console.log(id); 
            this.$router.push({name: 'each-order', params: {id: id}})
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