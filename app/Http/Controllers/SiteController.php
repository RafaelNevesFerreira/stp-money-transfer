<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return "memes";
    }
}
