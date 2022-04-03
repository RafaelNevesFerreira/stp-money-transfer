<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostsRepositoryInterface;

class BlogController extends Controller
{
    public function __construct(public PostsRepositoryInterface $posts)
    {
    }

    public function blog()
    {
        $posts = $this->posts->all();
        return view("blog.blog", compact("posts"));
    }

    public function post($slug)
    {
        $post = $this->posts->whereSlug($slug);
        return view("blog.post",compact("post"));
    }
}
