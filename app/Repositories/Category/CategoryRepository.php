<?php

namespace App\Repositories\Category;

use App\Http\Resources\CategoryCollection;
use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function all()
    {
        return new CategoryCollection(Category::all());
    }

    public function create(array $category)
    {
        return Category::create([
            'title' => $category['title'],
            'description' => $category['description'],
            'photo' => $category['photo'],
            'status' => $category['status']
        ]);
    }
}
