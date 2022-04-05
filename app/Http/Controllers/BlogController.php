<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TagsRepositoryInterface;
use App\Repositories\Contracts\PostsRepositoryInterface;

class BlogController extends Controller
{
    public function __construct(public PostsRepositoryInterface $posts,public TagsRepositoryInterface $tags)
    {
    }

    public function blog()
    {
        $posts = $this->posts->all_posts();
        $tags = $this->tags->all_tags();

        return view("blog.blog", compact("posts","tags"));
    }

    public function post($slug)
    {
        $post = $this->posts->whereSlug($slug);
        $tags = $this->tags->all_tags();

        return view("blog.post",compact("post","tags"));
    }

    public function tag($tag){
        $posts = $this->tags->whereTag($tag)->posts;

        $tags = $this->tags->all_tags();


        return view("blog.blog",compact("posts","tags"));
    }


}
