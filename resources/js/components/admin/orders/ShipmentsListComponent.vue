<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Customer Shipments List
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        顧客発送リスト
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-btn 
            color="primary"
            outlined
            @click="csvExport(csvData)"
            class="mb-6"
        >
            ダウンロード
        </v-btn>
        <v-simple-table  height="300px">
            <template>
                <thead>
                    <tr>
                        <th class="text-left jp-font-400">
                            注文ID
                        </th>
                        <th class="text-left jp-font-400">
                            顧客
                        </th>
                        <th class="text-left jp-font-400">
                            宛名
                        </th>
                        <th class="text-left jp-font-400">
                            電話番号
                        </th>
                        <th class="text-left jp-font-400">
                            住所
                        </th>
                        <th class="text-left jp-font-400">
                            発送予定日
                        </th>
                        <th class="text-left jp-font-400">
                            希望配達時間
                        </th>
                        <th class="text-left jp-font-400">
                            ステータス
                        </th>
                        <th class="text-left jp-font-400">
                            さらにみる
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in shipmentOrders" :key="index">
                        <td class="jp-font-400">
                            {{order.id}}
                        </td>
                        <td class="jp-font-400">
                            {{order.user_name}}様
                        </td>
                        <td class="jp-font-400">
                            {{order.delivery_name}}様
                        </td>
                        <td class="jp-font-400">
                            {{order.delivery_phone}}
                        </td>
                        <td class="jp-font-400">
                            〒{{order.delivery_zipcode}}<br>
                            {{order.delivery_prefecture}}{{order.delivery_city}}
                            {{order.delivery_address_1}}<br>
                            {{order.delivery_building}}
                        </td>
                        <td class="jp-font-400">
                            {{order.scheduled_date}}
                        </td>
                        <td class="jp-font-400">
                            {{order.delivery_time}}
                        </td> 
                        <td>
                            <v-chip :color="getColor(order.status)" dark>{{ order.status }}</v-chip>
                        </td> 
                        <td>
                            <v-btn
                                text
                            >
                                <v-icon
                                    small
                                    @click="expand(order.id)"
                                >mdi-open-in-new
                                </v-icon>
                            </v-btn>
                        </td> 
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
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
        this.$store.dispatch('admin/fetchShipmentOrders')
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'shipmentOrders',
        ]),
        csvData(){
            return this.shipmentOrders.map(item => ({
                ...item
            }))
        }
    
    },
    methods: {
        getColor(status){
            if (status == 'Ongoing') return '#67A8DD'
            else if (status == 'Scheduled') return '#85D1BB'
            else if (status == 'Packed') return '#85D1BB'
            else if (status == 'Shipped') return '#F0D117'
            else if (status == 'Delivered') return '#6B21B5'
            else if (status == 'Cancelled') return '#F7E3B5'
            else if (status == 'Missing') return '#F7E3B5'
            else if (status == 'Completed') return '#6B21B5'
            else return 'info'
        },
        expand(id){
            console.log(id); 
            this.$router.push({name: 'each-order', params: {id: id}})
        },
        csvExport(arrData){
            let csvContent = 
            "data:text/csv;charset=utf-8,";
            csvContent += [
                Object.keys(arrData[0]).join(";"),
                ...arrData.map(item => Object.values(item).join(";"))
            ]
            .join("\n")
            .replace(/(^\[)|(\]$)/gm, "");

             const data = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", data);
                link.setAttribute("download", "export.csv");
                link.click();
        }

        
    }


}
</script>

<style>

</style>