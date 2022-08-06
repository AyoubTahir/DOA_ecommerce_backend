<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResourse;
use App\Repositories\Category\ICategoryRepository;
use App\Services\Upload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function __construct(private ICategoryRepository $category)
    {
        $this->middleware('auth:sanctum', ['except' => ['index']]);
    }

    public function index(Request $request)
    {
        return $this->category->all($request->query());
    }

    public function show($id)
    {
        try {
            $category = $this->category->find($id);
        } catch (Exception $e) {

            return response()->json([
                'message' => 'Category Not Found'
            ], 401);
        }

        return new CategoryResourse($category);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->only(['title', 'description', 'photo', 'status']);

        if ($request->hasFile('photo')) {

            $data['photo'] =  Upload::save($request->file('photo'), 'images');
        }

        $category = $this->category->create($data);

        return new CategoryResourse($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->only(['title', 'description', 'status']);

        try {
            $category = $this->category->find($id);
        } catch (Exception $e) {

            return response()->json([
                'message' => 'Category Not Found'
            ], 401);
        }

        if ($request->hasFile('photo')) {

            $data['photo'] =  Upload::delete($category->getRawOriginal('photo'))->save($request->file('photo'), 'images');

        }

        $this->category->update($data, $id);

        return response()->json([
            'message' => 'Category Updated Successfully'
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $this->category->delete($id);
        } catch (Exception $e) {

            return response()->json([
                'message' => 'Category Not Found'
            ], 401);
        }

        return response()->json([
            'message' => 'Category Deleted Successfully'
        ], 200);
    }
}
