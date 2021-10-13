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
    color: rgba(0, 0, 0, 0.87)；
    /* text-size-adjust: 100%; */
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
td.align-right{
    text-align: right;
}

@media screen and (max-width:768px){
    /* body{
        font-size: 32px;
    } */
    .line{
        width: 
    }
   
}

</style>
<body>

    <div class="header">    
        <!-- <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg" alt="logo" class="logo"> -->
        <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.png" alt="logo" class="logo">
    </div>

    <h2 class="mb">ご購入をいただき、ありがとうございます。</h2>

    <p class="mobild">この度はaya & co.でお買い物いただき、誠にありがとうございます。</p>
    <p>商品がお手元に届くまで、こちらのメールを大切に保管ください。</p>

    <hr class="line">

    <div class="section">
        <p class="subheading">ご注文内容</p>

        <p>注文ID: {{$order['id']}}</p>

        <table class="mb20 font-32">
            <tr class="item-table">
                <td class="pr20">商品:</td>
                <td>
                    @foreach($order['products'] as $product)
                    <div class="font-32">
                        {{ $product['name']}}: {{ $product['pivot']['quantity']}}個 
                    </div>
                    @endforeach
                </td>
            </tr>
        </table>
        
        <table class="mb20">
            <tr>
                <td class="pr20">小計:</td>
                <td class="align-right">{{$order['item_total']}}円</td>
            </tr>
            <tr>
                <td class="pr20">送料:</td>
                <td class="align-right">{{$order['postage']}}円</td>
            </tr>
            <tr>
                <td class="pr20">合計:</td>
                <td class="align-right">{{$order['total']}}円</td>
            </tr>
        </table>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">決済方法</p>

        <p>クレジット決済</p>
    </div>

    <hr class="line">
    
    <div class="section">
        <p class="subheading">お届け先</p>

        <p>
            〒{{$order['delivery_zipcode']}}<br>
            {{$order["delivery_prefecture"]}}{{$order["delivery_city"]}}{{$order["delivery_address_1"]}}<br>
            @if(isset($order["delivery_building"]))
                {{$order["delivery_building"]}} <br>
            @endif
            {{$order["delivery_name"]}}様
        </p>
        <p>
            お電話番号: {{$order["delivery_phone"]}}
        </p>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">ご請求先</p>

        <p>
            〒{{$user -> zipcode}}<br>
            {{$user -> prefecture}}{{$user -> city}}{{$user -> address_1}}<br>
            @if(isset($user -> building))
                {{$user -> building}}<br>
            @endif
            {{$user -> name}}様
        </p>
        <p>お電話番号: {{$user -> phone}}</p>
        <p>メールアドレス: {{$user -> email}}</p>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">備考<p>

        @if(isset($order["message"]))
            <p>{{$order["message"]}}</p>
        @endif
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
            <p>住所:<br>
        
                〒216-0003<br>
                神奈川県川崎市宮前区有馬1-6-1-505<br>
                aya & co. <br>
                代表　上田文子
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