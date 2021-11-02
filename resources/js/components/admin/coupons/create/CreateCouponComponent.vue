<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Create Coupons
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        クーポン登録
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-btn
                        color="primary"
                        outlined
                        @click="$router.push({name: 'coupons-list'})"
                >
                        リストへもどる
                </v-btn>
            </v-col>
            <v-col cols="12" sm="12" md="6">
                <v-form 
                    ref="form" 
                    v-model="valid"
                    lazy-validation
                >
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                v-model="name"
                                label="名前" 
                                outlined
                                required
                                :rules="nameRules"
                                :error="otherError.name ? true : false"
                                :error-messages="otherError.name"
                            ></v-text-field>
                            <v-text-field
                                v-model="type"
                                label="タイプ"
                                required
                                outlined
                                :rules="typeRules"
                                :error="otherError.type ? true : false"
                                :error-messages="otherError.type"
                            ></v-text-field>
                            <v-text-field
                                v-model="value"
                                label="値"
                                outlined
                                :error="otherError.value ? true : false"
                                :error-messages="otherError.value"
                            ></v-text-field>
                            <v-text-field
                                v-model="percentOff"
                                label="オフ率"
                                outlined
                                :error="otherError.percent_off ? true : false"
                                :error-messages="otherError.percent_off"
                            ></v-text-field>
                            <v-text-field
                                v-model="minimum"
                                label="最小累計金額"
                                outlined
                                :error="otherError.percent_off ? true : false"
                                :error-messages="otherError.percent_off"
                            ></v-text-field>
                            <v-date-picker
                                v-model="deadline"
                                color = "primary"
                            ></v-date-picker>
                            <v-btn 
                                block 
                                dark 
                                color="primary" 
                                class="mb-2" 
                                @click="create()"
                                :loading="loading"
                            >
                                登録する
                            </v-btn>
                            <!-- <v-btn text color="primary" class="pa-0" @click.stop="toLogin()">ログインする</v-btn> -->
                        </v-col>
                    </v-row>
                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: {
    },
    data: function(){
        return{
            valid: true,
            name: '',
            nameRules: [
                (v) => !!v || '名前を入力してください。',
            ],
            type: '',
            typeRules: [
                (v) => !!v || 'タイプを入力してください。',
            ],
            value: '',
            percentOff: '',
            minimum: '',
            deadline: '',
    
        }
    },
    mounted(){
        // this.$store.dispatch('fetchCategories');
    },
    computed: {
        ...mapState('coupon', [
            'otherError',
            'loading',
        ]),
        ...mapState([
           
        ])
    },
    methods: {
        ...mapActions('coupon', [
            'createCoupon'
        ]),
        create(){    

            // this.$store.commit('admin/setLoading', true);

            if(this.$refs.form.validate()){
                this.createCoupon({
                    name: this.name,
                    type: this.type,
                    value: this.value,
                    percentOff: this.percentOff,
                    minimum: this.minimum,
                    deadline: this.deadline,
                    status_id: 16,
                })
            }
        }, 
        // toLogin(){
        //     // this.$router.push({name: 'admin-login'});
        //     window.location = "/admin/login"
        // }
    }


}
</script>

<style>

</style>
        
  