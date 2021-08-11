<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        About
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        プロフィール
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <!-- <div>
                    {{ item.title }}
                </div>
                <div>
                    {{ item.text }}
                </div>
                <v-row>
                    <v-col md="4">
                        {{ item.title }}
                    </v-col>
                    <v-col md="8">
                        {{ item.text }}
                    </v-col>
                </v-row> -->
                <v-row align="end mb24">
                    <v-col cols="12" sm="12" md="2">
                        <div>
                            <v-img
                                max-width=120
                                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/ayako_grey.png"
                            >
                            </v-img>
                        </div>
                    </v-col>
                    <v-col cols="12" sm="12" md="10">
                        <div class="name">
                            <span class="jobtitle">Founder</span><br>
                            Ayako Towatari
                        </div>
                    </v-col>
                </v-row>
                
                
                <div class="jp-serif-400-16 grey--text text--darken-2 mb-6">
                    <p>
                        マーマレードのレシピが初めて歴史上にあらわれるのは、<br class="lg">1677年ごろのことだそうです。
                    </p>
                    <p>
                        イングランド北西部のイライザ・チョムリーという女性が、<br class="lg">
                        出版したレシピブックのなかで「オレンジのマルマレット」を書き残しています。
                    </p>
                    <p>
                        それから350年近く、マーマレードが生き続けているのは、<br class="lg">
                        毎日の生活のなか、<br class="sm">とりわけ朝目覚めたときに必ずそこにあることに、<br class="lg">
                        人間にとってベーシックな<br class="sm">美しさと喜びがあるからだと感じます。
                    </p>
                    <p>
                        同じことがマーマレードを作るという行為そのものにもいえます。<br>
                        果物という自然の恵みを、果実と果汁だけでなく、皮から種にいたるまで<br>
                        どこもあますことなく使うこと。<br>
                        それを口にする誰かに喜びをもたらすことを祈りながら、時間をかけてつくること。<br>
                    </p>
                    <p>
                        人間を幸せにするものだから、ずっと作りつづけたいマーマレード。<br>
                        こうして、aya & co.として、Little Black Jarsをスタートさせました。
                    </p>
                </div>
                <div class="divider-image bird-image">
                    <v-img
                        max-width=120
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/bird.png"
                    ></v-img>
                </div>
                <div>
                    <div class="jobtitle mb-2">Profile</div>
                    <div class="jp-sanserif-400-14 mb-8">
                        <p>
                            早稲田大学第一文学部卒業、ロンドン大学歴史学研究所研究修士号<br>
                            2006-2008年、大阪大学大学院文学研究科助教を経て、<br>
                            2009-2019年、英国の公的な国際文化交流機関ブリティッシュ・カウンシルで<br>
                            日本とイギリスを繋ぐ教育・研究事業のプロジェクトマネージャーを務める。<br>
                            2019年、デジタルハリウッドのStudio渋谷にてWebデザインを、<br>
                            2020年、ジーズアカデミーでプログラミングを学ぶ。<br>
                            2021年、aya & co.を創業。
                            <br>
                        </p>
                    </div>
                    <div class="jobtitle mb-2">Works</div>
                    <div class="jp-sanserif-400-14 mb-8">
                        <p>
                            マーマレード・ジャムの製作と販売<br>
                            ウェブサイトのデザインと制作<br>
                        </p>
                    </div>
                    <div class="jobtitle mb-2">Contact</div>
                    <div class="jp-sanserif-400-14 mb-6">
                        <p>
                            お問い合わせは、<a href="https://forms.gle/kSJ8nj9ennqwvvai8" target="_blank" rel="noopener noreferrer">メールフォーム</a>、
                            もしくは<a href="https://lin.ee/1RJJ9C3" target="_blank" rel="noopener noreferrer">LINE公式アカウント</a>よりお願いいたします。
                        </p>
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
            // items:  [
            //     {title: '送料はいくらですか？', text: '<router-link to:"/postage">こちらのページ</router-link>でご覧いただけます。'},
            // ],
            
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
.jobtitle{
    font-family: ltc-kennerley, serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 0.03em;
    font-size: 14px;
}

.name{
    font-family: ltc-kennerley, serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 0.03em;
    font-size: 18px;
}

.jp-serif-400-16{
    font-family: 'Noto Serif JP', serif;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    letter-spacing: 0.03em;
    line-height: 1.6;
}

.jp-sanserif-400-14{
    line-height: 1.5;
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 300;
    font-style: normal;
    font-size: 14px;
    letter-spacing: 0.03em;
    line-height: 1.6;
}

.mb24{
    margin-bottom: 24px;
}

@media(max-width:780px){
   .bird-image{
       max-width: 90px;
   }
}

</style>