<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCoupon(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $request->validate([
            'coupon_code' => 'required',
        ]);

        $coupon_code = request('coupon_code');

        $coupon = Coupon::where('name', $coupon_code)
                        ->whereDate('date_by', '>=', Carbon::now()->toDateString())
                        ->first();

        if(empty($coupon)){
            return response() ->json(['errors' => ['coupon' => 'このクーポンは現在、提供されていません。']], 400);
            // return response() ->json(['errors' => 'このクーポンは現在提供されていません。'], 400);
        }else{
            $redeemed = $coupon->users()->first();

            if(!$redeemed){
    
                return response() -> json(['coupon'=>$coupon]);
                
            }else{
    
                return response() ->json(['errors' => ['coupon' => 'このクーポンは使用済みです。']], 400);
            }
        }
    }

    public function storeCouponData(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'coupon' => 'required',
        ]);

        $coupon_array = request('coupon');

        if($coupon_array['applied'] !== false){
            $coupon_id = $coupon_array['id'];

            $coupon = Coupon::find($coupon_id);
            // DD($coupon);

            $coupon->users()->attach($user->id);
        }
    }

    public function createCoupon(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $coupon = new Coupon();

        $coupon->name = request('name');
        $coupon->type = request('type');
        $coupon->value = request('value');
        $coupon->percent_off = request('percentOff');
        $coupon->minimum = request('minimum');
        $coupon->date_by = request('dateBy');
        $coupon->status_id = request('status_id');

        $coupon->save();

        $coupons = Coupon::get();

        return response() -> json(['coupons'=>$coupons]);

    }

    //会員が、2回目購入用のcouponにeligibleかどうかを確認する
    public function checkIfCoupon(Request $request)
    {
        $user = Auth::user();

        if(!$user){
            return response() -> json(['check'=> false]);
        }else{

            $coupon_code = 'thanks10';

            $coupon = Coupon::where('name', $coupon_code)->first();

            $one_order = Order::where('orders.user_id', '=', $user->id)->count();

            // $first_order = Order::where('orders.user_id', '=', $user->id)->oldest()->first();

            // $order_date = new Carbon($first_order->created_at);

            // DD($order_date);

            if($one_order >= 1){

                $redeemed = $coupon->users()->first();

                if(!$redeemed){

                    // $deadline = Carbon::now()->subMonths(6);
                    $deadline = new Carbon('2021-11-30');
                    $now = new Carbon();

                    // DD($now);

                    if($now->gt($deadline)){

                        return response() -> json(['check'=> false]);

                    }else{

                        return response() -> json(['check'=> true]);

                    }
                    
                }else{
        
                    return response() -> json(['check'=> false]);;
                }
            }

        }
        
    }

    //Adminのクーポンリスト表示用
    public function fetchCoupons()
    {
       
        $coupons = Coupon::join('statuses', 'statuses.id', '=', 'coupons.status_id')
                    ->select(
                        'coupons.id',
                        'name',
                        'type',
                        'value',
                        'percent_off',
                        'minimum',
                        'date_by',
                        'status'
                    )
                    ->get();

        return response() -> json(['coupons'=>$coupons]);
        
    }
    // public function fetchCoupons()
    // {
    //     $user = Auth::user();

    //     $item_total = $user->orders()->sum('item_total');
    //     $discounts = $user->orders()->sum('discount');
    //     $total = $item_total - $discounts;

    //     if($total >= 5000 && $total <= 9999 ){


            

    //     }

       

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
