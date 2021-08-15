<template>
    <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Edit Profile
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    プロフィール編集
                  </div>
              </div>
          </v-col>
      </v-row>
      <v-row>
          <v-col cols="12" sm="12" md="4">
              
          </v-col>
          <v-col cols="12" sm="12" md="8">
                <div class="mb-6">
                    <div class="item-content policy-title">
                        名前（フリガナ）
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-3">
                        {{ user.name }}（{{ user.kana }}）
                    </div>
                    <div>
                        <v-btn
                            color="primary"
                            outlined
                            v-if="!isEditingName"
                            @click="$store.commit('setIsEditingName', true)"
                        >
                            編集
                        </v-btn>
                    </div>
                    <div v-if="isEditingName">
                        <editname-component
                            v-bind:user='user'
                        ></editname-component>
                    </div>
                </div>

                <v-divider class="mb-6"></v-divider>

                <div class="mb-6">
                    <div class="item-content policy-title">
                        住所・電話番号
                    </div>
                    <div class="mb-3">
                        <div class="mb-2">
                            <div class="item-title grey--text text--darken-3">
                                〒{{ user.zipcode }} {{ user.prefecture}}{{ user.city }}{{ user.address_1 }}
                            </div>
                            <div v-if="user.building !== null" class="item-title grey--text text--darken-3">
                                {{ user.building }}
                            </div>
                        </div>
                        <div>
                            {{ user.phone }}
                        </div>
                    </div>
                    <div>
                        <v-btn
                            color="primary"
                            outlined
                            v-if="!isEditingAddress"
                            @click="$store.commit('setIsEditingAddress', true)"
                        >
                            編集
                        </v-btn>
                    </div>
                    <div v-if="isEditingAddress">
                        <editaddress-component
                            v-bind:user='user'
                        ></editaddress-component>
                    </div>
                </div>

                <v-divider class="mb-6"></v-divider>

                <div class="mb-6">
                    <div class="item-content policy-title">
                        メールアドレス
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-3">
                        {{ user.email }}
                    </div>
                    <div>
                        <v-btn
                            color="primary"
                            outlined
                            v-if="!isEditingEmail"
                            @click="$store.commit('setIsEditingEmail', true)"
                        >
                            編集
                        </v-btn>
                    </div>
                    <div v-if="isEditingEmail">
                        <editemail-component
                            v-bind:user='user'
                        ></editemail-component>
                    </div>
                </div>

                <v-divider class="mb-6"></v-divider>

                 <div class="mb-6">
                    <div class="item-content policy-title">
                        パスワード
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-3">
                        ********
                    </div>
                    <div>
                        <v-btn
                            color="primary"
                            outlined
                            v-if="!isEditingPassword"
                            @click="$store.commit('setIsEditingPassword', true)"
                        >
                            編集
                        </v-btn>
                    </div>
                    <div v-if="isEditingPassword">
                        <editpassword-component
                            v-bind:user='user'
                        ></editpassword-component>
                    </div>
                </div>
          </v-col>
      </v-row>
    </v-container>
  
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            valid: true,
            name: '',
            nameRules: [
                (v) => !!v || '名前を入力してください。',
            ],
            kana: '',
            kanaRules: [
                v => !!v || 'フリガナを入力してください。',
            ],
            zipcode: '',
            zipcodeRules: [
                v => !!v || '郵便番号を入力してください。',
                v => v.length == 7 || 'ハイフンなしで、数字7桁を入力してください。'
            ], 
            state: '',
            prefectureRules: [
                v => !!v || '都道府県を入力してください。',
            ],
            city: '',
            cityRules: [
                v => !!v || '市町村を入力してください。',
            ],
            address1: '',
            address1Rules: [
                v => !!v || '番地・部屋番号等を入力してください。',
            ],
            building: '',
            phone: '',
            phoneRules: [
                v => !!v || '電話番号を入力してください。',
            ],
            email: '',
            emailRules: [
                (v) => !!v || 'メールを入力してください。',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'メールアドレスが正しくありません。'
            ],
            confirmEmail: '',
            confirmEmailRules: [
                (v) => !!v || 'メールアドレスの確認が必要です。',
                (v) => v == this.email || 'メールアドレスが一致していません。'
            ],   
            password: '',
            passwordRules: [
                (v) => !!v || 'パスワードを入力してください。',
                (v) => v.length >= 8 || 'パスワードは8文字以上です。'
            ],
            password_confirmation: '',
            confirmPasswordRules: [
                (v) => !!v || '確認のためパスワードを入力してください。',
                (v) => v == this.password || 'パスワードが一致しません。'
            ],      
            showPassword: false,
            showPassword2: false
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'user',
            'isEditingName',
            'isEditingAddress',
            'isEditingEmail',
            'isEditingPassword',
        ])
    
    },
    methods: {
      

        
    }


}
</script>

<style>
.mb60 {
  margin-bottom: 60px;

}

@media(max-width:780px){
    .pine-image{
      max-width: 90px;
    }
}

</style>