<template>
    <v-container>
        <div class="key-visual">
            <v-img
                max-width=1137
                max-height=636
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/card_2.jpg"
                class="hidden-sm-and-down"
            ></v-img>
            <v-img
                max-width=360
                max-height=183
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/card_2.jpg"
                class="hidden-md-and-up"
            ></v-img>
        </div>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Custum Card Service
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    選べるメッセージカードサービス
                  </div>
              </div>
          </v-col>
      </v-row>
      <!-- <div class="mb-10">
          <p class="description">
            aya & co. では、環境に優しい包装に取り組んでいます。
          </p>   
      </div> -->
      <!-- <p class="description">
        このページでは、私たちが環境に対してどのようにアプローチしていくかをご紹介いたします。現在、準備中です。
      </p>    -->
      <v-row>
          <v-col cols="12" sm="12" md="4">
              <p class="item-title">マーマレードに気持ちを添えて</p>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <p class="description">
                  マーマレードを手にとっていただくのは、<br class="lg">
                  頑張ったご自身へのねぎらいの贈り物であったり、<br class="lg">
                  少し疲れた時に勇気づけるためかもしれません。<br>
                  あるいは、もうすぐ誕生日を迎えるご家族やご友人のことを想っていたり、<br class="lg">
                  感謝の気持ちを誰かに伝えたくて、マーマレードを選んでいただくのかもしれません。<br class="lg">
                  自分にとって大切な人に愛情を贈ろうとされている方もいらっしゃると思います。<br>
              <p class="description">
                  aya & co.では、ご注文時に、商品の発送時に同封されるカードのメッセージをお選びいただき、<br class="lg">
                  さらに、ギフトとして贈られる場合は、カードの差出人としてお客様のお名前を印字するサービスを無料で提供しています。ぜひご利用ください。<br class="lg">
              </p>
              <p class="description">
                  なおこのサービスは、<router-link to="/postage">配送方法</router-link>として「ゆうパック（日本郵便）」をお選びいただく場合にのみ、ご利用いただけます。「宅急便コンパクト（ヤマト運輸）」をお選びいただく際にはご利用になれませんので、ご注意ください。
              </p>
              <div class="divider-image pine-image balloon-image">
                    <v-img
                        max-width=90
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/balloon.png"
                    ></v-img>
              </div>
              <!-- <div class="my-4">
                    <v-img
                        max-width="320"
                        class="mx-auto card-image"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/card_happyBD.jpg"
                    ></v-img>
              </div> -->
              <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        選べるメッセージ
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>現在、メッセージは、以下のなかからお選びいただけます。</p>
                        <p>
                            Thank You（ありがとう）<br>
                            Happy Birthday（お誕生日おめでとう）<br>
                            Take Care（お身体にお気をつけて）<br>
                            Get Well Soon（早く元気になリますように）<span class="font-14">*病気などからの回復期に使われます。</span><br>
                            With Love（愛を込めて）<span class="font-14">*ご家族やご親友に親愛の情を示す時にも使われます。</span><br>
                            Sending You a Hug（ハグをおくります）<span class="font-14">*少し落ち込んでいるご友人やご家族をなぐさめたり、元気づけるメッセージです。</span>
                        </p>
                        <p>
                            括弧内の日本語訳は印字されず、英字のみとなります。また、白地のポストカードタイプの用紙を使用しており、裏面には、aya & co.のご案内がプリントされています。<br>
                        </p>
                        <p>
                            ご自宅用にご注文いただいた場合も、ご自身へのメッセージとしてお選びいただけます。
                        </p>
                        <p>
                            メッセージの種類は随時増やしていく予定です。もし「こんなメッセージのカードがあれば」というご要望がありましたら、<a href="https://lin.ee/1RJJ9C3" target="_blank" rel="noopener noreferrer">LINE公式アカウント</a>からのご意見もお受付けしております。
                        </p>
                    </div>
                </div>

                <v-row class="mb-8">
                    <v-col cols="12" sm="12" md="12" class="line-color">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>

                <div class="mb-8">
                    <div class="item-content line-height policy-title mb-4">
                        カスタムプリントされるお名前
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            ご自宅以外の宛先にギフトとしてお贈りされる場合は、お客様のお名前をカードの差出人として英字で印字いたしますので、パーソナライズされたカードをお贈りいただけます。
                            以下の2種類のなかから、表記をお選びいただけます。
                        </p>
                        <p>
                            姓・名両方を表記（例：Haruka Kikuchi)<br>
                            下のお名前のみを表記（例：Haruka）<br>
                        </p>
                        <p>
                            お名前は、ご登録いただいた「フリガナ」をもとに印字いたしますので、「フリガナ」の記載に間違いのないようご確認ください。
                        </p>
                    </div>
                </div>

                <v-row class="mb-8">
                    <v-col cols="12" sm="12" md="12" class="line-color">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>

                <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        お申し込み方法
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            選べるメッセージカードサービスは、会員登録をしていただいたお客様で、ゆうパック（日本郵便）での配送を選択された方に限り、ご利用いただけます。
                            <router-link to="/guest/register">会員登録</router-link>をしていただいてから、ログインした状態でご注文のお手続きへお進みください。
                            ご注文の際に、ゆうパック（日本郵便）をお選びいただくと、メッセージカードのご利用をお申し込みいただけます。
                        </p>
                        <p class="mb-6">
                            選べるメッセージカードサービスについて、ご質問・ご相談のある方は、ご遠慮なくお問い合わせください。
                        </p>
                        <div>
                            <v-btn
                                href = "https://lin.ee/1RJJ9C3"
                                outlined
                                color="primary"
                            >
                            LINEに友だち追加する
                            </v-btn>
                        </div>
                    </div>
                </div>
          </v-col>
      </v-row>
    </v-container>
  
</template>

<script>
export default {
    data: function(){
        return {
            images:[
                { name: 'sample1', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/vintage_sample.JPG'},
                { name: 'sample2', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/key_bagel.JPG'},
                { name: 'sample3', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/kirigamine.png'},
            ]
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
.mb60 {
  margin-bottom: 60px;
}
.card-image{
    border: 0.5px solid #727272;
}
.font-14{
    font-size: 14px;
}

.line-color .theme--light.v-divider{
    border-color: #FE6862;
    border-style: dotted;
    /* background-image: linear-gradient(to right, black 33%, rgba(255,255,255,0) 0%);
    background-position: bottom;
    background-size: 3px 1px;
    background-repeat: repeat-x; */

}

.balloon-image{
    margin-top: 60px;
    margin-bottom: 60px;
}

.line-height{
    line-height: 1.8;
}

@media(max-width:780px){
    
}

</style>