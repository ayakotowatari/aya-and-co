<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Create Product
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        商品登録
                    </div>
                </div>
            </v-col>
        </v-row>
            <v-row justify="center">
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
                                :error="allerror.name ? true : false"
                                :error-messages="allerror.name"
                            ></v-text-field>
                            <v-text-field
                                v-model="size"
                                label="サイズ"
                                outlined
                                :error="allerror.size ? true : false"
                                :error-messages="allerror.size"
                            ></v-text-field>
                            <v-text-field
                                v-model="slug"
                                label="スラッグ"
                                outlined
                                :error="allerror.slub ? true : false"
                                :error-messages="allerror.slug"
                            ></v-text-field>
                             <v-text-field
                                v-model="price"
                                label="価格"
                                outlined
                                :error="allerror.price ? true : false"
                                :error-messages="allerror.price"
                            ></v-text-field>
                             <v-select
                                v-model="category"
                                label = "カテゴリー"
                                :items="categories"
                                item-text="name"
                                item-value="id"
                            >
                            </v-select>
                             <v-text-field
                                v-model="inventory"
                                label="在庫数"
                                outlined
                                :error="allerror.inventory ? true : false"
                                :error-messages="allerror.inventory"
                            ></v-text-field>
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
            size: '',
            slug: '',
            price: '',
            category: '',
            inventory: '',
    
        }
    },
    mounted(){
        this.$store.dispatch('fetchCategories');
    },
    computed: {
        ...mapState('admin', [
            'allerror',
            'loading',
        ]),
        ...mapState([
            'categories'
        ])
    },
    methods: {
        ...mapActions('admin', [
            'createProduct'
        ]),
        create(){    

            this.$store.commit('admin/setLoading', true);

            if(this.$refs.form.validate()){
                this.createProduct({
                    name: this.name,
                    size: this.size,
                    slug: this.slug,
                    price: this.price,
                    category_id: this.category,
                    inventory: this.inventory,
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
        
  