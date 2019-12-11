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
        $validatedData = $request->validate([
            'donator' => 'required',
            'amount' => 'required',
            'address' => 'required',
            'address2' => 'nullable',
            'city' => 'required',
            'state' => 'required | max:2',
            'zip' => 'required | max:5',
            'phone' => 'required',
            'email' => 'required',
            'stripeToken' => 'required'
        ]);
    
        try {
            $this->doPayment($request->stripeToken, $request->amount);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        $donation = new Donation;
        $donation->donator = $request->donator;
        $donation->ammount = $request->amount;
        $donation->address = $request->address;
        $donation->address2 = $request->address2;
        $donation->city = $request->city;
        $donation->state = $request->state;
        $donation->zip = $request->zip;
        $donation->phone = $request->phone;
        $donation->email = $request->email;
        $donation->save();
        Mail::to('info@christianlaw.org')->send(new NewDonation($donation));
        $name = env('APP_NAME');
        $image = env('APP_IMAGE');
        return view('success', compact('name', 'image'));
    }

    protected function doPayment($token, $amount)
    {
        Stripe::setApiKey(env('STRIPE_KEY', null));
        $name = env('APP_NAME');
        $connect = env('STRIPE_CONNECT', null);
        if(is_numeric($amount)){
            $correctedAmount = $amount * 100;
            if($connect){
                $charge = Charge::create([
                'source' => $token,
                'amount'   => $correctedAmount,
                'currency' => 'usd',
                'description' => "Donation to $name",
                ], ["stripe_account" => $connect]);
            }else{
                $charge = Charge::create([
                'source' => $token,
                'amount'   => $correctedAmount,
                'currency' => 'usd',
                'description' => "Donation to $name"
            ]);    
        }
        }
    }
}