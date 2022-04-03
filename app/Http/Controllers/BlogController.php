<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostsRepositoryInterface;

class BlogController extends Controller
{
    public $posts;
    public function __construct(PostsRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    public function blog(){
        $posts = $this->posts->all();
        return view("blog.blog",compact("posts"));
    }
}
