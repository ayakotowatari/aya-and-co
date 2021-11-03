<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Create Email News
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        会員メール送信
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
                            <v-file-input 
                                v-model="image"
                                accept="image/*" 
                                label="画像"
                                outlined
                                placeholder="画像を選択する"
                                :error="allerror.image ? true : false"
                                :error-messages="allerror.image">
                            </v-file-input>
                            <v-text-field
                                v-model="p1Heading"
                                label="P1タイトル" 
                                outlined
                                required
                                :rules="headingRules"
                                :error="allerror.p1_heading ? true : false"
                                :error-messages="allerror.p1_heading"
                            ></v-text-field>
                            <v-textarea
                                v-model="p1Main"
                                label="P1テキスト"
                                outlined
                                required
                                rows="8"
                                :error="allerror.p1_main ? true : false"
                                :error-messages="allerror.p1_main"
                            ></v-textarea>
                            <v-text-field
                                v-model="p2Heading"
                                label="P2タイトル" 
                                outlined
                                :error="allerror.p2_heading ? true : false"
                                :error-messages="allerror.p2_heading"
                            ></v-text-field>
                            <v-textarea
                                v-model="p2Main"
                                label="P2テキスト"
                                outlined
                                rows="8"
                                :error="allerror.p2_main ? true : false"
                                :error-messages="allerror.p2_main"
                            ></v-textarea>
                            <v-text-field
                                v-model="p2Link"
                                label="P2リンク" 
                                outlined
                                :error="allerror.p2_heading ? true : false"
                                :error-messages="allerror.p2_heading"
                            ></v-text-field>
                            <v-text-field
                                v-model="p3Heading"
                                label="P3タイトル" 
                                outlined
                                :error="allerror.p3_heading ? true : false"
                                :error-messages="allerror.p3_heading"
                            ></v-text-field>
                            <v-textarea
                                v-model="p3Main"
                                label="P3テキスト"
                                outlined
                                rows="8"
                                :error="allerror.p3_main ? true : false"
                                :error-messages="allerror.p3_main"
                            ></v-textarea>
                            <v-text-field
                                v-model="p3Link"
                                label="P3リンク" 
                                outlined
                                :error="allerror.p2_heading ? true : false"
                                :error-messages="allerror.p2_heading"
                            ></v-text-field>
                             <v-text-field
                                v-model="p4Heading"
                                label="P4タイトル" 
                                outlined
                                :error="allerror.p4_heading ? true : false"
                                :error-messages="allerror.p4_heading"
                            ></v-text-field>
                            <v-textarea
                                v-model="p4Main"
                                label="P4テキスト"
                                outlined
                                rows="8"
                                :error="allerror.p4_main ? true : false"
                                :error-messages="allerror.p4_main"
                            ></v-textarea>
                              <v-text-field
                                v-model="p4Link"
                                label="P4リンク" 
                                outlined
                                :error="allerror.p2_heading ? true : false"
                                :error-messages="allerror.p2_heading"
                            ></v-text-field>
                            <v-text-field
                                v-model="p5Heading"
                                label="P5タイトル" 
                                outlined
                                :error="allerror.p5_heading ? true : false"
                                :error-messages="allerror.p5_heading"
                            ></v-text-field>
                            <v-textarea
                                v-model="p5Main"
                                label="P5テキスト"
                                outlined
                                rows="8"
                                :error="allerror.p5_main ? true : false"
                                :error-messages="allerror.p5_main"
                            ></v-textarea>
                              <v-text-field
                                v-model="p5Link"
                                label="P4リンク" 
                                outlined
                                :error="allerror.p5_link ? true : false"
                                :error-messages="allerror.p5_link"
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
    data: function(){
        return{
            valid: true,
            image: {},
            imageRules: [
                v => !v || v.size < 3000000 || '画像のサイズは3 MBまでです。',
            ],
            p1Heading: '',
            headingRules: [
                (v) => !!v || 'タイトルを入力してください。',
            ],
            p1Main: '',
            textRules: [
                (v) => !!v || 'テキストを入力してください。',
            ],
            p1Link: '',
            p2Heading: '',
            p2Main: '',
            p2Link: '',
            p3Heading: '',
            p3Main: '',
            p3Link: '',
            p4Heading: '',
            p4Main: '',
            p4Link: '',
            p5Heading: '',
            p5Main: '',
            p5Link: '',
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
            'createEmailNews'
        ]),
        create(){    

            this.$store.commit('admin/setLoading', true)

            if(this.$refs.form.validate()){
                this.createEmailNews({
                    image: this.image,
                    p1_heading: this.p1Heading,
                    p1_main: this.p1Main,
                    p2_heading: this.p2Heading,
                    p2_main: this.p2Main,
                    p2_link: this.p2Link,
                    p3_heading: this.p3Heading,
                    p3_main: this.p3Main,
                    p3_link: this.p3Link,
                    p4_heading: this.p4Heading,
                    p4_main: this.p4Main,
                    p4_link: this.p4Link,  
                    p5_heading: this.p5Heading,
                    p5_main: this.p5Main,
                    p5_link: this.p5Link,
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
        
  