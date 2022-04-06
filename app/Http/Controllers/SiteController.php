<?php

namespace App\Http\Controllers;

use Session;
use Stripe;

class SiteController extends Controller
{
    public function index(){

        return view("site.welcome");
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

    public function help(){
        return view("site.help");
    }

    public function contact(){
        return view("site.contact");
    }

    public function privacity(){
        return view("site.politica-privacidade");
    }
}
