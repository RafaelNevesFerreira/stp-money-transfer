<?php

namespace App\Http\Controllers;

use App\Mail\ReviewMail;
use Illuminate\Http\Request;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Repositories\Contracts\ReviewsRepositoryInterface;

class SiteController extends Controller
{
    public function __construct(
        public FaqRepositoryInterface $faqs,
        public ReviewsRepositoryInterface $reviews,
        public ContactRepositoryInterface $contact,
    ) {
    }
    public function index()
    {
        $total = $this->faqs->all()->count();
        $faqs = $this->faqs->metade($total / 2, $total);
        $reviews = $this->reviews->limit(10);

        return view("site.welcome", compact("faqs", "reviews"));
    }

    public function review()
    {
        return view("site.review");
    }

    public function review_submit(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "content" => "required|max:300|min:3",
            "country" => "required"
        ]);

        $this->reviews->create($request->all());

        return redirect()->route("home");
    }

    public function about()
    {
        $reviews = $this->reviews->limit(10);
        return view("site.about", compact("reviews"));
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
        $contact = $this->contact->firstorfail(1);
        return view("site.contact", compact("contact"));
    }

    public function privacity()
    {
        return view("site.politica-privacidade");
    }
}
