<?php

namespace App\Repositories\Contracts;

interface TagsRepositoryInterface{
    public function all_tags();
    public function whereTag($tag);
}
