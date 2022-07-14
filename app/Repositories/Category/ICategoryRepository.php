<?php

namespace App\Repositories\Category;


interface ICategoryRepository
{
    public function all();

    public function create(array $category);
}
