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
                        ->whereDate('deadline', '>=', Carbon::now()->toDateString())
                        ->first();

        if(empty($coupon)){
            return response() ->json(['errors' => ['coupon' => 'このクーポンは現在、提供されていません。']], 400);
            // return response() ->json(['errors' => 'このクーポンは現在提供されていません。'], 400);
        }else{

            $redeemed = $coupon-> users() -> where('user_id', $user_id) ->first();

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
        $coupon->deadline = request('deadline');
        $coupon->status_id = request('status_id');

        $coupon->save();

        $coupons = Coupon::get();

        return response() -> json(['coupons'=>$coupons]);

    }

    //会員が、2回目購入用のcouponにeligibleかどうかを確認する
    public function checkIfCoupon()
    {
        $user = Auth::user();

        if(!$user){
            return response() -> json(['check'=> false]);
        }else{

            $coupon_code = 'thanks10';

            $coupon = Coupon::where('name', $coupon_code)->first();

            $one_order = Order::where('orders.user_id', '=', $user->id)->count();

            if($one_order > 0){

                $redeemed = $coupon-> users() -> where('user_id', $user->id) ->first();

                // DD($redeemed);

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
        
                    return response() -> json(['check'=> false]);
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
                        'deadline',
                        'status'
                    )
                    ->get();

        return response() -> json(['coupons'=>$coupons]);
        
    }

     //Adminの各クーポン詳細
     public function fetchCoupon($id)
     {
         $coupon = Coupon::join('statuses', 'statuses.id', '=', 'coupons.status_id')
                        ->where('coupons.id', $id)
                        ->select(
                            'coupons.id',
                            'name',
                            'type',
                            'value',
                            'percent_off',
                            'minimum',
                            'deadline',
                            'status'
                        )
                        ->first();
    
         return response() -> json(['coupon'=>$coupon]);
         
     }

     public function editName (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $coupon_id = request('id');
        $name = request('name');

        $coupon = Coupon::find($coupon_id);

        $coupon->name = $name;
        $coupon->update();

        $updated_name = $coupon->name;

        return response() -> json(['name'=>$updated_name]);

     }

     public function editType (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);

        $coupon_id = request('id');
        $type = request('type');

        $coupon = Coupon::find($coupon_id);

        $coupon->type = $type;
        $coupon->update();

        $updated_type = $coupon->type;

        return response() -> json(['type'=>$updated_type]);

     }

     public function editValue (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'value' => 'required',
        ]);

        $coupon_id = request('id');
        $value = request('value');

        $coupon = Coupon::find($coupon_id);

        $coupon->value = $value;
        $coupon->update();

        $updated_value = $coupon->value;

        return response() -> json(['value'=>$updated_value]);

     }

     public function editPercentOff (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'percentOff' => 'required',
        ]);

        $coupon_id = request('id');
        $percent_off = request('percentOff');

        $coupon = Coupon::find($coupon_id);

        $coupon->percent_off = $percent_off;
        $coupon->update();

        $updated_percentOff = $coupon->percent_off;

        return response() -> json(['percentOff'=>$updated_percentOff]);

     }

     public function editMinimum (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'minimum' => 'required',
        ]);

        $coupon_id = request('id');
        $minimum = request('minimum');

        $coupon = Coupon::find($coupon_id);

        $coupon->minimum = $minimum;
        $coupon->update();

        $updated_minimum = $coupon->minimum;

        return response() -> json(['minimum'=>$updated_minimum]);

     }

     public function editDeadline (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'deadline' => 'required',
        ]);

        $coupon_id = request('id');
        $deadline = request('deadline');

        $coupon = Coupon::find($coupon_id);

        $coupon->deadline = $deadline;
        $coupon->update();

        $updated_deadline = $coupon->deadline;

        return response() -> json(['deadline'=>$updated_minimum]);

     }

     public function editStatus (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'status_id' => 'status_id',
        ]);

        $coupon_id = request('id');
        $status_id = request('status_id');

        $coupon = Coupon::find($coupon_id);

        $coupon->status_id = $status_id;
        $coupon->update();

        $updated_status = $coupon->status()->status;

        return response() -> json(['status'=>$updated_status]);

     }

     public function statuses()
    {
        // $statuses = Status::whereNotNull('status')->get();

        $statuses = Status::whereIn('id', [1, 17])
        ->get();

        // DD($statuses);

        return response() -> json(['statuses' => $statuses]);   

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
