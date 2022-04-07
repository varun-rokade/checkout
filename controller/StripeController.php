<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;



class StripeController extends Controller
{
    public function stripeorder(Request $request)
    {

        if(Session::has('coupon'))
        {
            $total_amount = Session::get('coupon')['total_amount'];
        }
        else
        {
            $total_amount = round(Cart::total());
        }



            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            \Stripe\Stripe::setApiKey('sk_test_51KlpgySCJu1vZ2fW2zOJB6sXEXEsW8ARGGu55mgT4UkqHMD9vsIjdw3WU0Bn8W6KftE2WO4TB3ZAmbJkYfRdLrJT00o2CKeysl');

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $_POST['stripeToken'];

            $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'usd',
            'description' => 'Easy Online Store',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
            ]);

            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'payment_type' => 'Stripe',
                'payment_method' => 'Stripe',
                'payment_type' => $charge->payment_method,
                'transaction_id' => $charge->balance_transaction,
                'currency' => $charge->currency,
                'amount' => $total_amount,
                'order_number' => $charge->metadata->order_id,
                'invoice_no' => 'EOS'.mt_rand(100000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
            ]);


            $carts = Cart::content();
            foreach($carts as $cart)
            {
                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),
                ]);
            }


            if(Session::has('coupon'))
            {
                Session::forget('coupon');
            }
            Cart::destroy();


            $notification = array( 
                'message' => 'Your Order Has Been Placed',
                'alert-type' => 'success'
            );
    
            return redirect()->route('dashboard')->with($notification);
    }
}
