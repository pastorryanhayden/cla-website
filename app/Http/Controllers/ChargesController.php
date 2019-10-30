<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChargesRequest;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use App\Customer as Cust;
use App\Mail\OrderCreated;
use App\Mail\OrderShipped;
use App\Mail\OrderConfirmation;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Mail;


class ChargesController extends Controller
{
    public function index(ChargesRequest $request)
    {
        
         // Step 1:
         // Validate the request
        $validated = $request->validated();


       
        // Step 2:
        // Create a Customer or Select one if exists.
        $customer = Cust::firstOrNew([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);
        $customer->address1 = $validated['address1'];
        $customer->address2 = $validated['address2'];
        $customer->city = $validated['city'];
        $customer->state = $validated['state'];
        $customer->zip = $validated['zip'];
        $customer->save();

        // Step 3:
        // Charge Stripe Using the Connect ID.
        try {
            $this->doPayment($validated['stripeToken'], $validated['email'], $validated['ammount']);
        } catch (Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught
            $body = $e->getJsonBody();
            $err  = $body['error'];
            return $err;
            print('Status is:' . $e->getHttpStatus() . "\n");
            print('Type is:' . $e->getStripeError()->type . "\n");
            print('Code is:' . $e->getStripeError()->code . "\n");
            // param is '' in this case
            print('Param is:' . $e->getStripeError()->param . "\n");
            print('Message is:' . $e->getStripeError()->message . "\n");
        } catch (Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            return 'Too many requests made to the API too quickly';
        } catch (Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            return 'Invalid parameters were supplied to Stripes API';
        } catch (Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            return "Authentication with Stripe's API failed";
            // (maybe you changed API keys recently)
        } catch (Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            return "Network communication with Stripe failed";
        } catch (Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            return "Some other error";
            // yourself an email
        } catch (Exception $e) {
            return "This is something else entirely.";
            // Something else happened, completely unrelated to Stripe
        }

        // Step 4:
        // Create an Order
        $order = new Order;
        $order->customer_id = $customer->id;
        $order->order_status = 'charged';
        $order->save();

        // Step 5:
        // Add Items to Order
        // Current issue is array to string conversion issue.
        // $items = collect($validated['items']);
        // $items->each(function ($item, $key) {
            
        // });
        
        foreach($validated['items'] as $item)
        {
            $orderItem = new OrderItem;
            $orderItem->title = $item['title'];
            $orderItem->order_id = $order->id;
            $orderItem->author = $item['author.name'];
            $orderItem->category = $item['categories'][0];
            $orderItem->cost = $item['cost'];
            $orderItem->description = $item['description'];
            $orderItem->quantity = $item['quant'];
            $orderItem->save();
        }

        // Send Order Summary to Company
        Mail::to(env('COMPANY_EMAIL'))->send(
            new OrderCreated($order)
        );

        // Send An Email to the Customer Confirming Order
        Mail::to($order->customer->email)->send(
            new OrderConfirmation($order)
        );
        // Return a Success string
        return response()->json('Success', 200);

    }
    public function complete($id){
        $order = Order::find($id);
        $order->order_status = "shipped";
        $order->save();
        // Send an email to the customer letting them know their order has shipped.
        Mail::to($order->customer->email)->send(
            new OrderShipped($order)
        );

        return view('complete', compact('order'));
    }

    protected function doPayment($token, $email, $amount)
    {
        return $token;
        $stripeKey = env('STRIPE_KEY');
        $stripeConnect = env('STRIPE_CONNECT');

       

        Stripe::setApiKey($stripeKey);
        
        $stripecustomer = Customer::create(array(
            'email' => $email,
            'card'  => $token->card->id
        ));

        
        // $correctedAmount = $amount * 100;
        
        
        $charge = Charge::create(array(
            'amount'   => $amount,
            'currency' => 'usd',
            'source' => $token->card->id, 
            'description' => "Books from CLA",
            ["stripe_account" => $stripeConnect ]
        ));
    }
}

