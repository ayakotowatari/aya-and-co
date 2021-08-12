<!DOCTYPE html>
<html lang="jp">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/jcr3wqt.css"> -->

<!-- Styles -->

</head>
<style type="text/css">
@font-face {
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src: url('{{ storage_path('fonts/ipag.ttf') }}') format('truetype');
}
@font-face {
    font-family: ipag;
    font-style: bold;
    font-weight: bold;
    src: url('{{ storage_path('fonts/ipag.ttf') }}') format('truetype');
}

body {
    padding: 32px;
    font-family: 'ipag';
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    color: rgba(0, 0, 0, 0.87)；
    /* text-size-adjust: 100%; */
}
.text-center{
    text-align: center
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
.pr20{
    padding-right: 20px;
}
.mb10{
    margin-bottom: 10px;
}
.mb20{
    margin-bottom: 20px;
}
.mb30{
    margin-bottom: 30px;
}

.underline{
    text-decoration: underline;
    padding: 6px;
}

/* table, th, td{
    border: 1px solid black;
    width: 100%;
    border-collapse: collapse;
} */

table.main-table{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 6px;
}

.main-table th{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 6px;
}
.main-table td{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 6px;
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

    <!-- <div class="header">    
        <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg" alt="logo" class="logo">
    </div> -->

    <!-- <h1 class="text-center">
        <img src="{{ asset('/image/logo.png')}}" alt="aya & co.のロゴ">
    </h1> -->
    
    <h2>納品書兼領収書</h2>

    <p class="mb30">{{ \Carbon\Carbon::now()->format("Y年n月j日") }} </p>

    <p class="mb20">{{ $user->name}}様</p>

    <p class="underline">合計金額：¥{{ $user->total}}</p>

    <!-- <hr class="line"> -->

    <div class="section">
        <table class="main-table">
            <tr>
                <th>品名</th>
                <th>サイズ</th>
                <th>数量</th>
                <th>単位</th>
                <th>単価（¥）</th>
                <th>金額（¥）</th>
            </tr>

            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->size }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>個</td>
                    <td>{{ $order->unit_price }}</td>
                    <td>{{ $order->item_price }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="sub-table">
            <tr>
                <td>小計</td>
                <td>¥{{ $user -> item_total }}</td>
            </tr>
            <tr>
                <td>送料</td>
                <td>¥{{ $user -> postage }}</td>
            </tr>
            <tr>
                <td>合計</td>
                <td>¥{{ $user -> total}}</td>
            </tr>
        </table>
    </div>

    <hr>

    <div class="mb20">
        <p>
            この度のご購入、誠にありがとうございました。<br>
            お気に召していただけましたら幸いです。<br>
            またのご利用をお待ちしております。
        </p>
    </div>

    <hr>
    
    <div class="section">
        <p>上記金額を領収いたしました。</p>

        <p>{{ \Carbon\Carbon::now()->format("Y年n月j日") }} </p>

        <p>
            〒216-0003　神奈川県川崎市宮前区有馬1-6-1-505<br>
            aya & co.代表　上田文子
        </p>
    </div>

    <hr>

    <div class="mb20">
        <p class="subheading">お問い合わせ先</p>
            <p>
                メールアドレス: ayaandco.info@gmail.com<br>
                LINE公式アカウント: https://lin.ee/1RJJ9C3
            </p>
    </div>

    <div>
        <p class="mb20">
            備考　注文ID：{{ $user -> order_id}}
        </p>
    </div>
    
</body>
</html>