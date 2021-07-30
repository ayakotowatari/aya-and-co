<!DOCTYPE html>
<html lang="jp">
<head>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/jcr3wqt.css">

        <!-- Styles -->
        
</head>
<style>

body {
    padding: 32px;
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    color: rgba(0, 0, 0, 0.87)
    /* text-size-adjust: 100%; */
}
#button {
    width: 200px;
    text-align: center;
}
#button a {
    padding: 10px 20px;
    display: block;
    border: 1px solid #FE6862;
    background-color: #FFFFFF;
    color: #FE6862;
    text-decoration: none;
    /* box-shadow: 2px 2px 3px #f5deb3; */
}
.header{
    text-align: center;
    margin-bottom: 20px;
}
.logo{
    max-width: 160px;
}
.line {
    text-align: left;
    margin-left: 0px;
    max-width: 300px;
}
.subheading{
    font-weight: 700;

}
.item-table{
    vertical-align: text-top;
}
.section{
    margin-top: 20px;
    margin-bottom: 20px;
}
.pr20{
    padding-right: 20px;
}
.mb10{
    margin-bottom: 10px;
}
.mb20{
    margin-bottom: 20px;
}
td.align-right{
    text-align: right;
}

@media screen and (max-width:768px){
    /* body{
        font-size: 32px;
    } */
}

</style>
<body>

    <div class="header">
        <img src="/assets/img/logo_1.png" alt="logo" class="logo">
    </div>

    <h2 class="mb">パスワードリセット</h2>

    <p class="mobild">このメールは、お客様からパスワードリセットの申請があったため、お送りしています。</p>
    <p class="mb20">下記のボタンをクリックし、パスワードリセットの手続きへお進みください。</p>

    <p id="button" class="mb20">
        <a href="{{$reset_url}}">パスワードリセット</a>
    </p>

    <p>このパスワードリセット用のリンクは、60分で失効します。</p>

    <p>上記のボタンが作動しない場合は、以下のURLをブラウザーにコピーペーストしてパスワードリセットの手続きへお進みください：</p>

    <p>{{ $reset_url }}</p>

    <hr class="line">
    
    <p>もしお客様がパスワードリセットを申請されなかった場合は、何もアクションをとっていただく必要はございません。</p>

    <hr class="line">

    <div class="section">
        <p class="subheading">お問い合わせ</p>
        <div class="mb20">
            <p>
                メールアドレス:<br>
                aya-and-co@gmail.com
            </p>
        </div>
        <div class="mb20">
            <p>住所:<br>
        
                〒216-0003<br>
                神奈川県川崎市宮前区有馬1-6-1-505<br>
                上田方<break>
                aya & co. 宛
            </p>
        </div>
        <!-- <table>
            <tr class="item-table">
                <td class="pr20">メールアドレス</td>
                <td>aya-and-co@gmail.com</td>
            </tr>
            <tr class="item-table">
                <td class="pr20">住所</td>
                <td>
                〒216-0003<br>
                神奈川県川崎市宮前区有馬1-6-1-505<br>
                上田方<break>
                aya & co. 宛
                </td>
            </tr>
        </table> -->
    </div>
    
</body>
</html>