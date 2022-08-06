<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductRepository implements IProductRepository
{

    public function create(array $product)
    {
        return Product::create([
            'user_id' => Auth::id(),
            'category_id' => $product['category_id'],
            'title' => $product['title'],
            'description' => $product['description'],
            'purchase_price' => $product['purchase_price'],
            'selling_price' => $product['selling_price'],
            'total_stock' => $product['total_stock'],
            'status' => 1
        ]);
    }

    public function addImages(Product $product, string $imagePath )
    {
        return $product->images()->create([
            'image' => $imagePath
        ]);
    }

    public function addVariations(Product $product, $variations )
    {
        return $product->variations()->saveMany($this->variations($variations));
    }

    private function variations($variations)
    {
        $data = [];

        foreach(json_decode($variations, TRUE) as $variation)
        {
            $data[] = new Variation(
                [   
                    'color' => $variation['color'],
                    'size' => $variation['size'],
                    'stock' => $variation['stock']
                ]);
        }

        return $data;
    }

}
