<!DOCTYPE html>
<html lang="jp">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
    padding: 24px;
    font-family: 'Noto Sans JP', sans-serif!important;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    color: rgba(0, 0, 0, 0.87)!important;
    background-color: #ffffff!important;
    /* text-size-adjust: 100%; */
}
img{
    width :100%;
    margin: 0 auto;
}
.header{
    text-align: center;
    margin-bottom: 20px;
}
.logo{
    max-width: 160px;
}
.line {
    max-width: 300px;
    text-align: left;
    margin-left: 0px;
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

/* .section a{
    color: #fff;
    background: #FE6862;
    padding: 10px 30px;
    display: inline-block;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    text-decoration: none;
} */
.btn-link{
    color: #fff;
    background: #FE6862;
    padding: 10px 30px;
    display: inline-block;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    text-decoration: none;
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
        <!-- <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg" alt="logo" class="logo"> -->
        <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.png" alt="logo" class="logo">
    </div>

    <div>
        <img src="{{$news['image']}}" alt="">
    </div>

    <h2 class="mb">{{ $news['p1_heading']}}</h2>

    <div class="section">

        <!-- <p>この度はaya & co.でお買い物いただき、誠にありがとうございます。</p>
        <p>商品がお手元に届くまで、こちらのメールを大切に保管ください。</p> -->
        <p>
            {!! $news['p1_main'] !!}
        </p>
        <p>
            {!! $news['p1_menu'] !!}
        </p>
    </div>

    @if(isset($news['p2_heading']))

    <hr class="line">

    <div class="section">

        <p class="subheading">
            {{$news['p2_heading']}}
        </p>

        <p>
            {!! $news['p2_main'] !!}
        </p>

        @if(isset($news['p2_link']))
        <p>
            <a href="{{ $news['p2_link']}}" class="btn-link">{{$news['p2_btntext']}}</a>
        </p>
        @endif

    </div>

    @endif

    @if(isset($news['p3_heading']))

    <hr class="line">

    <div class="section">

        <p class="subheading">
            {{$news['p3_heading']}}
        </p>

        <p>
            {!! $news['p3_main'] !!}
        </p>

        @if(isset($news['p3_link']))
        <p>
            <a href="{{ $news['p3_link']}}" class="btn-link">{{$news['p3_btntext']}}</a>
        </p>
        @endif


    </div>

    @endif

    @if(isset($news['p4_heading']))

    <hr class="line">

    <div class="section">

        <p class="subheading">
            {{$news['p4_heading']}}
        </p>

        <p>
            {!! $news['p4_main'] !!}
        </p>

        @if(isset($news['p4_link']))
        <p>
            <a href="{{ $news['p4_link']}}" class="btn-link">{{$news['p4_btntext']}}</a>
        </p>
        @endif

    </div>

    @endif

    @if(isset($news['p5_heading']))

    <hr class="line">

    <div class="section">

        <p class="subheading">
            {{$news['p5_heading']}}
        </p>

        <p>
            {!! $news['p5_main'] !!}
        </p>

        @if(isset($news['p5_link']))
        <p>
            <a href="{{ $news['p5_link']}}" class="btn-link">{{$news['p5_btntext']}}</a>
        </p>
        @endif

    </div>

    @endif

    <hr class="line">

    <div class="section">
        <p>
            メール配信の停止方法：<br>
            ウェブサイトに会員としてログイン後、メニュー一覧にある「アカウント情報の編集」ページから、停止をお手続きいただけます。
        </p>

    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">お問い合わせ</p>

        <div class="mb20">
            <p>
                メールアドレス:<br>
                ayaandco.info@gmail.com
            </p>
        </div>
        <div class="mb20">
            <p>
                ウェブサイト:<br>
                https://www.ayaandco.com
            </p>
        </div>
        <div class="mb20">
            <p>LINE公式アカウント:<br>
               https://lin.ee/1RJJ9C3
            </p>
        </div>
    </div>
    
</body>
</html>