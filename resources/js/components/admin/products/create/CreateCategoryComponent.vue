<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Create Category
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        カテゴリー登録
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
                            <v-textarea
                                v-model="subtitle"
                                label="サブタイトル"
                                outlined
                                rows="3"
                                :error="allerror.subtitle ? true : false"
                                :error-messages="allerror.subtitle"
                            ></v-textarea>
                            <v-textarea
                                v-model="details"
                                label="詳細"
                                outlined
                                rows="2"
                                :error="allerror.details ? true : false"
                                :error-messages="allerror.details"
                            ></v-textarea>
                            <v-textarea
                                v-model="description"
                                label="説明文"
                                outlined
                                rows="15"
                                :error="allerror.description ? true : false"
                                :error-messages="allerror.description"
                            ></v-textarea>
                            <v-textarea
                                v-model="season"
                                label="シーズン"
                                outlined
                                :error="allerror.season ? true : false"
                                :error-messages="allerror.season"
                            ></v-textarea>
                            <v-textarea
                                v-model="ingredients"
                                label="原材料"
                                outlined
                                rows='3'
                                :error="allerror.ingredients ? true : false"
                                :error-messages="allerror.ingredients"
                            ></v-textarea>
                            <v-file-input 
                                v-model="image"
                                accept="image/*" 
                                label="画像"
                                outlined
                                placeholder="画像を選択する"
                                :error="allerror.image ? true : false"
                                :error-messages="allerror.image">
                            </v-file-input>

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
    data: function(){
        return{
            valid: true,
            name: '',
            nameRules: [
                (v) => !!v || '名前を入力してください。',
            ],
            subtitle: '',
            subtitleRules: [
                v => !!v || 'サブタイトルを入力してください。',
            ],
            details: '',
            detailsRules: [
                v => !!v || '詳細を入力してください。',
                v => v.length == 50 || '50字以内で入力してください。'
            ], 
            description: '',
            descriptionRules: [
                v => !!v || '説明文を入力してください。',
                v => v.length == 800 || '800字以内で入力してください。'
            ],
            season: '',
            seasonRules: [
                v => !!v || 'シーズンを入力してください。',
            ],
            ingredients: '',
            ingredientsRules: [
                v => !!v || '原材料を入力してください。',
            ],
            image: {},
            imageRules: [
                v => !v || v.size < 3000000 || '画像のサイズは3 MBまでです。',
            ],
            email: '',
        }
    },
    computed: {
        ...mapState('admin', [
            'allerror',
            'loading'
        ])
    },
    methods: {
        ...mapActions('admin', [
            'createCategory'
        ]),
        create(){    

            this.$store.commit('admin/setLoading', true);

            if(this.$refs.form.validate()){
                this.createCategory({
                    name: this.name,
                    subtitle: this.subtitle,
                    details: this.details,
                    description: this.description,
                    season: this.season,
                    ingredients: this.ingredients,
                    image: this.image,
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
        
  