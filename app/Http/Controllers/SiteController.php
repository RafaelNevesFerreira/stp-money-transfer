<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class SiteController extends Controller
{
    public function index()
    {
        return view("site.welcome");
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from tutsmake.com."
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function about()
    {
        return view("site.about");
    }

    public function send()
    {
        return view("site.send");
    }

    public function identification()
    {
        return view("site.send_identification");
    }

    public function payment()
    {
        return view("site.payment");
    }
}
