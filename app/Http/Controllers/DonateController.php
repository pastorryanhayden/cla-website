<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use App\Donation;
use App\Mail\NewDonation;
use Illuminate\Support\Facades\Mail;

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
        $donation = new Donation;
        $donation->donator = $request->donator;
        $donation->ammount = $request->ammount;
        $donation->address = $request->address;
        $donation->phone = $request->phone;
        $donation->email = $request->email;
        $donation->save();
        Mail::to($request->email)->send(new NewDonation($donation));
        $name = env('APP_NAME');
        $image = env('APP_IMAGE');
        return view('success', compact('name', 'image'));
    }

    protected function doPayment($token, $email, $amount)
    {
        Stripe::setApiKey(env('STRIPE_KEY', null));
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
            'description' => "Donation to $name",
            "transfer_data" => [
                "destination" => $connect,
              ],
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