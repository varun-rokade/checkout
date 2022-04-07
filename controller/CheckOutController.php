<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function getdistrict($division_id)
    {
        $ship = ShipDistrict::where('division_id',$division_id)->orderby('district_name','ASC')->get();
        return json_encode($ship);       
    }

    public function getstate($district_id)
    {
        $state = ShipState::where('district_id',$district_id)->orderby('state_name','ASC')->get();
        return json_encode($state);
    }


    public function checkoutstore(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $data['shipping_name'] = $request->shipping_name;
        $cart_total = Cart::total();    


        if($request->payment_method ==  'stripe')
        {
            return view('frontend.payment.stripe',compact('data','cart_total'));
        }
        elseif($request->payment_method == 'card')
        {
            return 'card';    
        }
        else
        {
            return 'cash';
        }



    }


}
