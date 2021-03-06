<!DOCTYPE html>
<html lang="en">
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

    <h2 class="mb">ご購入をいただき、ありがとうございます。</h2>

    <p class="mobild">このたびはaya & co.でお買い物いただき、誠にありがとうございます。</p>
    <p>商品がお手元に届くまで、こちらのメールを大切に保管ください。</p>
    <p>本メールは自動で配信しておりますためご返信いただけません。お問い合わせは、下記のお問い合わせ先よりお送りください。</p>

    <hr class="line">

    <div class="section">
        <p class="subheading">ご注文内容</p>

        <p>注文ID: {{$order -> id}}</p>

        <table class="mb20 font-32">
            <tr class="item-table">
                <td class="pr20">商品:</td>
                <td>
                    @foreach($order->products as $product)
                    <div>
                        {{ $product->name}}: {{ $product->pivot->quantity}}個 
                    </div>
                    @endforeach
                </td>
            </tr>
        </table>
        
        <table class="mb20">
            <tr>
                <td class="pr20">小計:</td>
                <td class="align-right">{{$order->item_total}}円</td>
            </tr>
            <tr>
                <td class="pr20">送料:</td>
                <td class="align-right">{{$order->postage}}円</td>
            </tr>
            <tr>
                <td class="pr20">合計:</td>
                <td class="align-right">{{$order->total}}円</td>
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
            〒{{$order->delivery_zipcode}}<br>
            {{$order->delivery_prefecture}}{{$order->delivery_city}}{{$order->delivery_address_1}}<br>
            @if(isset($order->delivery_building))
                {{$order->delivery_building}}<br>
            @endif
            {{$order->delivery_name}}様
        </p>
        <p>
            お電話番号: {{$order->delivery_phone}}
        </p>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">ご請求先</p>

        <p>
            〒{{$user -> zipcode}}<br>
            {{$user -> zipcode}}{{$user -> prefecture}}{{$user -> city}}{{$user -> address_1}}<br>
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

        <p>{{$order->message}}</p>
    </div>

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