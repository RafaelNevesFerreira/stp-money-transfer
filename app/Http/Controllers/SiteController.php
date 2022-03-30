<?php

namespace App\Http\Controllers;

use Session;
use Stripe;

class SiteController extends Controller
{
    public function index(){
        // return view("site.welcome");
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "description" => "Test payment from tutsmake.com."
        ]);

        Session::flash('success', 'Payment successful!');

        return "memes";
    }

    public function about(){
        return view("site.about");
    }

    public function send(){
        return view("site.send");
    }

    public function identification(){
        return view("site.send_identification");
    }

    public function payment(){
        return view("site.payment");
    }
}
