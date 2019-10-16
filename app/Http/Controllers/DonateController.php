<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class DonateController extends Controller
{

    public function index(Request $request)
    {
        $name = "Christian Law Association";
        $image = env('APP_IMAGE');
        $key = env('LIVE_KEY');
        

        return view('donate', [
            'amount' => $request->amount * 100,
            'description' => $request->description,
            'image' => $image,
            'name' => $name,
            'key' => $key
        ]);
    }

    public function submit(Request $request)
    {
        try {
            $this->doPayment($request->stripeToken, $request->email, $request->amount);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        $name = env('APP_NAME');
        $image = env('APP_IMAGE');
        return view('success', compact('name', 'image'));
    }

    protected function doPayment($token, $email, $amount)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $name = env('APP_NAME');
        $connect = env('STRIPE_CONNECT', null);
        $customer = Customer::create(array(
            'email' => $email,
            'card'  => $token
        ));
        $correctedAmount = $amount * 100;
        if($connect){
            $charge = Charge::create([
            'customer' => $customer->id,
            'amount'   => $correctedAmount,
            'currency' => 'usd',
            'description' => "Donation to $name"
        ], [
            "stripe_account" => ""
        ]);
        }else{
            $charge = Charge::create([
            'customer' => $customer->id,
            'amount'   => $correctedAmount,
            'currency' => 'usd',
            'description' => "Donation to $name"
        ]);
        }
        

    }
}