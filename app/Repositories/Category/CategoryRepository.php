<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Resources\CategoryCollection;

class CategoryRepository implements ICategoryRepository
{
    public function all(array $query)
    {

        if(!isset($query['search'])) $search = '';
        else $search = $query['search'];

        if(!isset($query['paginate'])) $paginate = 0;
        else $paginate = $query['paginate'];

        $categories = Category::with('user:id,name')
        ->orderBy('id', 'DESC')
        ->where('title', 'like', '%' . $search . '%')
        ->paginate($paginate);

        return new CategoryCollection($categories);
    }

    public function find(int $id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $category)
    {
        return Category::create([
            'user_id' => Auth::id(),
            'title' => $category['title'],
            'description' => $category['description'],
            'photo' => $category['photo'],
            'status' => $category['status']
        ]);
    }

    public function update(array $category, int $id)
    {
        return $this->find($id)->update($category);
    }

    public function delete(int $id)
    {
        $category = Category::findOrFail($id);

        $deleted = $category->delete();

        if ($deleted) {

            $filename = public_path($category->getRawOriginal('photo'));

            if (File::exists($filename)) {

                File::delete($filename);
            }
        }

        return $deleted;
    }
}
