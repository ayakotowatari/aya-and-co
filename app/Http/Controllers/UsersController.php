<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\Address;
use App\Models\Postage;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductInventory;
use App\Notifications\OrderNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;
use Notification;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function fetchUser()
    {
        $user = Auth::user();
        return response()->json(['user'=>$user],200);
    }

    //admin用に、会員の情報をとって、累計金額を入れる
    public function fetchUsers()
    {
        $users = User::where('life', 1)->get();

        // DD($users);

        foreach($users as $user){

            $user_id = $user->id;
            $subtotal = Order::where('orders.user_id', $user_id)->sum('item_total');
            $discounts = Order::where('orders.user_id', $user_id)->sum('discount');
            $total = $subtotal - $discounts;

            $user->total_spend = $total;
            $user->update();

        }

        $active_users = User::where('total_spend', '>', 0)->get();
        // DD($active_users);

        return response()->json(['users'=>$active_users]);
        
    }

    public function updateAddress(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            // 'name' => 'required',
            // 'kana' => 'required',
            'zipcode' => ['required', 'integer'],
            'prefecture' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address_1' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
        ]);

        // $user->name = request('name');
        // $user->kana = request('kana');
        $user->zipcode = request('zipcode');
        $user->prefecture = request('prefecture');
        $user->city = request('city');
        $user->building = request('building');
        $user->address_1 = request('address_1');
        $user->phone = request('phone');

        // if(request('building')){
        //     $user->building = request('building');
        // }else{
        //     $user->building = null;
        // }

        $user->update();

        return response()->json(['user'=>$user],200);

    }

    public function updateName(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
        ]);

        $user->name = request('name');
        $user->kana = request('kana');
        $user->update();

        $name = $user->name; 
        $kana = $user->kana;

        return response()->json(['name'=>$name, 'kana'=>$kana],200);

    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at'),],
        ]);

        $user->email = request('email');
        $user->update();

        $email = $user->email; 

        return response()->json(['email'=>$email],200);

    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make(request('password'));
        $user->update();

        return response()->json(['user'=>$user],200);

    }

    public function deleteUser(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $user->life = 0;
        $user->delete();

        // $deleted = $user->deleted_at;

        // if($deleted) {
        //     return redirect ('/');
        // }else{
        //     Auth::login($user);

        //     $message = 'アカウント削除に失敗しました。';

        //     return response()->json(['message'=>$message],200);
            
        // }
    }


    public function postage($id)
    {
        $courier_id = $id;
        
        $prefecture = Auth::user()->prefecture;

        $postage = Postage::where('courier_id', $courier_id)
                    ->where('prefecture', $prefecture)
                    ->select('postage')
                    ->first();

        $postage_res = $postage->postage;

        return response() -> json(['postage' => $postage_res]);
    }

    public function otherPostage($id)
    {
        $courier_id = $id;
        
        $prefecture = Auth::user()->prefecture;

        $postage = Postage::where('courier_id', $courier_id)
                    ->where('prefecture', $prefecture)
                    ->select('postage')
                    ->first();

        $postage_res = $postage->postage;

        return response() -> json(['postage' => $postage_res]);
    }

    //userの住所を配送先として追加する。
    public function addAddress(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            'name' => 'required',
            'kana' => 'required',
            'zipcode' => 'required | min:7',
            "prefecture" => 'required',
            "city" => 'required',
            "address_1" => 'required',
            "phone" => 'required',
            "delivery_time" => 'required'
        ]);

        $prefecture = request('prefecture');

        $postage = Postage::where('prefecture', $prefecture)
                    ->select('postage')
                    ->first();

        $postage_res = $postage->postage;

        $address = new Address();

        $address->user_id = $id;
        $address->type = 0;
        $address->name = request('name');
        $address->kana = request('kana');
        $address->zipcode = request('zipcode');
        $address->prefecture = request('prefecture');
        $address->city = request('city');
        $address->address_1 = request('address_1');
        $address->building = request('building');
        $address->phone = request('phone');
        $address->delivery_time = request('delivery_time');
        $address->postage = $postage_res;
        $address->life = 1;

        $address->save();

        return response()->json(['deliveryAddress'=>$address],200);
    }

    // public function test()
    // {
    //     $prefecture = "北海道";

    //     // DD($prefecture);

    //     $prefecture_string = Postage::where('prefecture', $prefecture)
    //                             ->select('postage')
    //                             ->first();

    //     // DD($prefecture_string);

    //     $res = $prefecture_string->postage;

    //     dd($res);

    //     // $postage = Postage::where('prefecture', 'like', $prefecture)
    //     //             ->select('postage')
    //     //             ->first();

    //     // DD($postage);

    // }

    //ほかの住所を配送先として追加する。
    public function otherAddress(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $request->validate([
            'name' => 'required',
            'kana' => 'required',
            'zipcode' => 'required | min:7',
            "prefecture" => 'required',
            "city" => 'required',
            "address_1" => 'required',
            "phone" => 'required',
        ]);

        // $prefecture = request('prefecture');

        // $postage = Postage::where('prefecture', $prefecture)
        //                 ->select('postage')
        //                 ->first();

        // $postage_res = $postage->postage;        

        $address = new Address();

        $address->user_id = $id;
        $address->type = 1;
        $address->name = request('name');
        $address->kana = request('kana');
        $address->zipcode = request('zipcode');
        $address->prefecture = request('prefecture');
        $address->city = request('city');
        $address->address_1 = request('address_1');
        $address->building = request('building');
        $address->phone = request('phone');
        // $address->postage = $postage_res;
        $address->life = 1;

        $address->save();

        // $addresses = $user->addresses()->orderBy('created_at', 'DESC')
        //                 ->get();

        // $addresses = Address::where('user_id', $id)
        //                     ->where('life', 1)
        //                     ->get();

        $addresses = $user->addresses()->where('life', 1)->orderBy('created_at', 'DESC')->get();

        return response()->json(['deliveryAddress'=>$address, 'otherAddresses'=>$addresses],200);
    }

    //自宅以外の住所のリストを取り出す。
    public function collectAddress(){

        $user = Auth::user();
        $id = $user->id;

        $addresses = $user->addresses()
                        ->where('user_id', $id)
                        ->where('type', 1)
                        ->where('life', 1)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        return response() -> json(['addresses' => $addresses]);
    }

    public function removeAddress(Request $request){

        $user = Auth::user();

        $request->validate([
            'id' => 'required',
        ]);

        $id = request('id');

        $address = Address::where('id', $id)
                    ->first();

        $address -> life = 0;
        $address->delete();

        $address -> save();

        $addresses = $user->addresses()
                        ->where('type', 1)
                        ->where('life', 1)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        return response() -> json(['otherAddresses' => $addresses]);
    }

//     public function purchase(Request $request){

//         $user = Auth::user();

//         // $success = 1; 

//         try {
//             $payment = $user->charge(
//                 $request->input('amount'),
//                 $request->input('payment_method_id')
//             );

//             $payment = $payment->asStripePaymentIntent();

//             $order = $user->orders()
//                 ->create([
//                     'total' => $payment->charges->data[0]->amount,
//                     'transaction_id' => $payment->charges->data[0]->id,
//                     'delivery_name' => $request->input('deliveryName'),
//                     'delivery_kana' => $request->input('deliveryKana'),
//                     'delivery_zipcode' => $request->input('deliveryZipcode'),
//                     'delivery_prefecture' => $request->input('deliveryPrefecture'),
//                     'delivery_city' => $request->input('deliveryCity'),
//                     'delivery_address_1' => $request->input('deliveryAddress1'),
//                     'delivery_building' => $request->input('deliveryBuilding'),
//                     'delivery_phone' => $request->input('deliveryPhone'),
//                     'delivery_time' => $request->input('deliveryTime'),
//                     'postage' => $request->input('deliveryPostage'),
//                     // 'delivery_time' => $request->input('delivery_time'),
//                 ]);

//             foreach(json_decode(request('cart'), true) as $item) {
//                 $order->products()
//                 ->attach($item['id'], ['quantity' => $item['quantity']]);
//             }
            
//             $order->load('products');
//             return $order;

//         }catch (\Exception $e){
//             return response() ->json(['message' => $e->getMessage()], 500);
//         }
// }

// public function test(Request $request){

//     // $cart = request('cart');
//     // dd($cart);

//     foreach(json_decode(request('cart'), true) as $item) {
        
//         // dd($item);
//         dd($item['quantity']);

//         // $id = $item['id'];
//         // $quantity = $item['quantity'];

//         // $product = Product::join("product_inventories", 'products.id', '=', 'product_inventories.product_id')
//         //             ->where('products.id', $id)
//         //             ->select('product_inventories.quantity')
//         //             ->first();

//         // // DD($product);

//         // $product->decrement('quantity', $quantity);

//         return response() -> json(['item' => $item]);
//     }
// }

public function purchase(Request $request){

    $user = Auth::user();

    // $payment_method_id = request('payment_method_id');
    // $payment_method_id = $request->input('payment_method_id');
    // DD($payment_method_id);

    // DD($user);

    try {

        $payment = $user->charge(
            $request->input('amount'),
            $request->input('payment_method_id')
        );

        // DD($payment);

        $payment = $payment->asStripePaymentIntent();

        $order = $user->orders()
            ->create([
                'total' => $payment->charges->data[0]->amount,
                'transaction_id' => $payment->charges->data[0]->id,
                'delivery_name' => $request->input('deliveryName'),
                'delivery_kana' => $request->input('deliveryKana'),
                'delivery_zipcode' => $request->input('deliveryZipcode'),
                'delivery_prefecture' => $request->input('deliveryPrefecture'),
                'delivery_city' => $request->input('deliveryCity'),
                'delivery_address_1' => $request->input('deliveryAddress1'),
                'delivery_building' => $request->input('deliveryBuilding'),
                'delivery_phone' => $request->input('deliveryPhone'),
                'delivery_courier' => $request->input('deliveryCourierType'),
                'delivery_time' => $request->input('deliveryTime'),
                'delivery_carduse' => $request->input('deliveryCardUse'),
                'delivery_cardmessage' => $request->input('deliveryCardMessage'),
                'delivery_cardname' => $request->input('deliveryCardName'),
                'message' => $request->input('deliveryMessage'),
                'postage' => $request->input('deliveryPostage'),
                'box_quantity' => $request ->input('deliveryBoxQuantity'),
                'item_total' => $request->input('itemTotal'),
                'discount' =>  $request->input('discount'),
                'status_id' => 1
                // 'delivery_time' => $request->input('delivery_time'),
            ]);

        // $shipment = $order->shipment()
        //     ->create([
        //         'order_id' => $order->id,
        //         'delivery_time' => $order->delivery_time,
        //         'postage' => $order->postage,
        //         'status_id' => 1
        //     ]);

        foreach(json_decode(request('cart'), true) as $item) {

            $price = $item['quantity'] * $item['price'];
            //DD($price);

            $order->products()
            //->attach($item['id'], ['quantity' => $item['quantity']], ['price' => $item['quantity']*$item['price']]);
            ->attach($item['id'], ['quantity' => $item['quantity'], 'price' => $price]);

            $order->products()->price = $price;

            $id = $item['id'];
            $quantity = $item['quantity'];

            // DD($quantity);

            // $product = ProductInventory::join("products", 'products.id', '=', 'product_inventories.product_id')
            //             ->where('products.id', $id)
            //             // ->select('product_inventories.quantity')
            //             ->first();

            $product = Product::where('id', $id)->first();

            // DD($product);
            $product->decrement('inventory', $quantity);

        }
        
        $order->load('products');
        
        return $order;

        // DD($order);

    // } catch (\Exception $e) {
    //     return response()->json(['message' => $e->getMessage()], 500);
    // }


    }catch(\Stripe\Exception\CardException $e){

        $error = "入力いただいたカードではお支払いいただけませんでした。再度お試しいただくか、別のカードをお試しください.";
        return response() ->json(['message' => $error], 500);

    }catch (\Stripe\Exception\RateLimitException $e){
        $error = "APIエラーです。再度お試しください。";
        return response() ->json(['message' => $error], 500);
        
    }catch (\Stripe\Exception\InvalidRequestException $e){
        $error = "パラメーターが無効です";
        return response() ->json(['message' => $error], 500);
        
    }catch (\Stripe\Exception\AuthenticationException $e){
        $error = "認証に失敗しました";
        return response() ->json(['message' => $error], 500);
        
    }catch (\Stripe\Exception\ApiConnectionException $e){
        $error = "通信エラーが発生しました";
        return response() ->json(['message' => $error], 500);
        
    }catch (\Stripe\Exception\ApiErrorExceptio $e){
        $error = "エラーが発生しました";
        return response() ->json(['message' => $error], 500);
        
    }catch (\Exception $e){
        $error = "エラーが発生しました。";
        return response() ->json(['message' => $error], 500);
    }

    // Notification::send($user, new OrderNotify($user));

    // $user->sendOrderNotify($user);

    // return view ('test');
    
}

    public function orderConfirm (Request $request)
    {
        $user = Auth::user();

        // DD($user);

        $order = request('order');

        // DD($order);

        //連想配列をオブジェクトに変える
        // function array_to_object($order) {
        //     $object = new stdClass;
        //     foreach($order as $key => $value) {
        //         if(strlen($key)) {
        //             if(is_array($value)) {
        //                 $object->{$key} = array_to_object($value);
        //             }else{
        //                 $object->${key} = $value;
        //             }
        //         }
        //     }
        //     return $object;
        // }

        // DD($orderObject);

        $user->sendOrderNotify($user, $order);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
