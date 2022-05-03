<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FaqRepositoryInterface;

class SiteController extends Controller
{
    public function __construct(public FaqRepositoryInterface $faqs)
    {
    }
    public function index()
    {
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
        $total = $this->faqs->all()->count();
        $first_faq = $this->faqs->metade(1, $total / 2);
        $second_faq = $this->faqs->metade($total / 2, $total);

        return view("site.help", compact("first_faq", "second_faq"));
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
