<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\Contracts\ReviewsRepositoryInterface;

class SiteController extends Controller
{
    public function __construct(public FaqRepositoryInterface $faqs, public ReviewsRepositoryInterface $reviews)
    {
    }
    public function index()
    {
        $total = $this->faqs->all()->count();
        $faqs = $this->faqs->metade($total / 2, $total);
        $reviews = $this->reviews->limit(10);

        return view("site.welcome", compact("faqs", "reviews"));
    }

    public function about()
    {
        $reviews = $this->reviews->limit(10);
        return view("site.about",compact("reviews"));
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
