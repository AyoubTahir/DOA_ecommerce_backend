<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResourse;
use App\Repositories\Category\ICategoryRepository;

class CategoryController extends Controller
{

    public function __construct(private ICategoryRepository $category)
    {
        //$this->middleware('auth:sanctum', ['except' => []]);
    }

    public function index()
    {
        return $this->category->all();
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->only(['title', 'description', 'photo', 'status']);

        if ($request->hasFile('photo')) {

            $data['photo'] =  $request->file('photo')->store('images');
        }

        $category = $this->category->create($data);

        return new CategoryResourse($category);
    }
}
