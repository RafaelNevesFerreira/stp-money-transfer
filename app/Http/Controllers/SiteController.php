<?php

namespace App\Http\Controllers;

use Session;
use Stripe;

class SiteController extends Controller
{
    public function index()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
          );
          $stripe->products->create([
            'name' => 'Gold Special',
            "price" => "120000"
          ]);
          dd("memes");
        return view("site.welcome");
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

    public function help()
    {
        return view("site.help");
    }

    public function contact()
    {
        return view("site.contact");
    }

    public function privacity()
    {
        return view("site.politica-privacidade");
    }
}
