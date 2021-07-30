<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

use App\Notifications\GuestOrderNotify;

class Guest extends Model
{
    //
    use Notifiable, Billable;

    protected $guarded =[];

    public function orders(){

        return $this->hasMany('App\Models\Order');

    }

    public function guestAddresses(){

        return $this->hasMany('App\Models\GuestAddress');

    }

    public function sendGuestOrderNotify($guest, $order){
        $this->notify(new GuestOrderNotify($guest, $order));
    }


}
