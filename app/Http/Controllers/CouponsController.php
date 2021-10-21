<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Auth;
use Illuminate\Http\Request;

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

        $coupon = Coupon::where('name', $coupon_code)->first();

        if(empty($coupon)){
            return response() ->json(['errors' => ['coupon' => 'このクーポンは現在提供されていません。']], 400);
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

    public function index()
    {
        //
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
