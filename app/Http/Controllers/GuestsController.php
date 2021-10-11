<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestAddress;
use App\Models\Postage;
use App\Models\ProductInventory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Notifications\GuestOrderNotify;
use Notification;


class GuestsController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request ->validate([
            'name' => 'required',
            'kana' => 'required',
            'zipcode' => 'required | min:7',
            "prefecture" => 'required',
            "city" => 'required',
            "address_1" => 'required',
            "phone" => 'required',
            'email' => 'required',
            // "delivery_time" => 'required'
        ]);

        // $prefecture = request('prefecture');
        // $postage = Postage::where('prefecture', $prefecture)
        //             ->select('postage')
        //             ->first();

        // $postage_res = $postage->postage;

        $guest = new Guest();

        $guest->name = request('name');
        $guest->kana = request('kana');
        $guest->zipcode = request('zipcode');
        $guest->prefecture = request('prefecture');
        $guest->city = request('city');
        $guest->address_1 = request('address_1');
        $guest->building = request('building');
        $guest->phone = request('phone');
        $guest->email = request('email');
        // $guest->delivery_time = request('delivery_time');

        $guest->save();

        // $guest_id = $guest->id;

        // $delivery_address = new GuestAddress();

        // $delivery_address->guest_id = $guest_id;
        // $delivery_address->type = 0;
        // $delivery_address->name = request('name');
        // $delivery_address->kana = request('kana');
        // $delivery_address->zipcode = request('zipcode');
        // $delivery_address->prefecture = request('prefecture');
        // $delivery_address->city = request('city');
        // $delivery_address->address_1 = request('address_1');
        // $delivery_address->building = request('building');
        // $delivery_address->phone = request('phone');
        // $delivery_address->delivery_time = request('delivery_time');
        // $delivery_address->postage = $postage_res;
        // $delivery_address->life = 1;

        // $delivery_address->save();

        // dd($guest_address);

        //  return view ('test', ['product'=>$product]);

        // return response() -> json(['deliveryAddress' => $delivery_address, 'guest' => $guest]);
        return response() -> json(['guest' => $guest]);

    }
    // public function otherAddress(Request $request)
    // {
    //     $request ->validate([
    //         // 'deliveryName' => 'required',
    //         // 'deliveryKana' => 'required',
    //         // 'deliveryZipcode' => 'required | min:7',
    //         // "deliveryPrefecture" => 'required',
    //         // "deliveryCity" => 'required',
    //         // "deliveryAddress_1" => 'required',
    //         // "deliveryPhone" => 'required',
    //         // "deliveryDeliveryTime" => 'required',
    //         'name' => 'required',
    //         'kana' => 'required',
    //         'zipcode' => 'required | min:7',
    //         "prefecture" => 'required',
    //         "city" => 'required',
    //         "address_1" => 'required',
    //         "phone" => 'required',
    //         'email' => 'required',
    //     ]);

    //     $guest = new Guest();

    //     $guest->name = request('name');
    //     $guest->kana = request('kana');
    //     $guest->zipcode = request('zipcode');
    //     $guest->prefecture = request('prefecture');
    //     $guest->city = request('city');
    //     $guest->address_1 = request('address_1');
    //     $guest->building = request('building');
    //     $guest->phone = request('phone');
    //     $guest->email = request('email');

    //     $guest->save();

    //     $other_prefecture = request('deliveryPrefecture');

    //     $other_postage = Postage::where('prefecture', $other_prefecture)
    //                         ->select('postage')
    //                         ->first();

    //     $res = $other_postage->postage;

    //     // $delivery_address = new GuestAddress();

    //     // $delivery_address->guest_id = $guest_id;
    //     // $delivery_address->type = 1;
    //     // $delivery_address->name = request('deliveryName');
    //     // $delivery_address->kana = request('deliveryKana');
    //     // $delivery_address->zipcode = request('deliveryZipcode');
    //     // $delivery_address->prefecture = request('deliveryPrefecture');
    //     // $delivery_address->city = request('deliveryCity');
    //     // $delivery_address->address_1 = request('deliveryAddress_1');
    //     // $delivery_address->building = request('deliveryBuilding');
    //     // $delivery_address->phone = request('deliveryPhone');
    //     // $delivery_address->delivery_time = request('deliveryDeliveryTime');
    //     // $delivery_address->postage = $res;
    //     // $delivery_address->life = 1;

    //     // $delivery_address->save();

    //     // dd($guest_address);

    //     //  return view ('test', ['product'=>$product]);

    //     return response() -> json(['postage' => $res, 'guest' => $guest]);

    // }
    

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

    public function addAddress(Request $request)
    {

    }

    public function purchase(Request $request){

        // $guest = Guest::firstOrCreate(

        //     [
        //         'email' => $request->input('email')
        //     ],
        //     [
        //         'name' => $request->input('name')
        //         // 'password' => Hash::make(Str::random(12))
        //     ]
        // );

        $guest_id = request('guest_id');

        $guest = Guest::find($guest_id);

        try {
            $payment = $guest->charge(
                $request->input('amount'),
                $request->input('payment_method_id')
            );

            $payment = $payment->asStripePaymentIntent();

            $order = $guest->orders()
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
                    'postage' => $request->input('deliveryPostage'),
                    'item_total' => $request->input('itemTotal'),
                    'status_id' => 1
                    // 'delivery_time' => $request->input('delivery_time'),
                    // 'guest_address_id' => $request->input('delivery_address'),
                ]);

            foreach(json_decode(request('cart'), true) as $item) {

                $price = $item['quantity'] * $item['price'];

                $order->products()
                ->attach($item['id'], ['quantity' => $item['quantity'], 'price' => $price]);

                $id = $item['id'];
                $quantity = $item['quantity'];

                // DD($quantity);

                //inventory変更前の設定
                // $product = ProductInventory::join("products", 'products.id', '=', 'product_inventories.product_id')
                //         ->where('products.id', $id)
                //         // ->select('product_inventories.quantity')
                //         ->first();
                // DD($product);

                $product = Product::where('id', $id)->first();

                $product->decrement('inventory', $quantity);

            }
            
            $order->load('products');
            return $order;

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

        // }catch (\Exception $e){
        //     return response() ->json(['message' => $e->getMessage()], 500);
        // }
}

public function orderConfirm (Request $request)
{
    $order = request('order');

    // DD($order);

    $guest_id = $order['guest_id'];

    // DD($guest_id);
    
    $guest = Guest::where('id', $guest_id)
                    ->first();

    // DD($guest);
    // DD($guest);

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

    $guest->sendGuestOrderNotify($guest, $order);

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
