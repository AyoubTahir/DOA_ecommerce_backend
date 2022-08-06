<?php

namespace App\Repositories\Product;

use App\Models\Product;


interface IProductRepository
{
    //public function all(array $query);

    //public function find(int $id);

    public function create(array $product);

    //public function update(array $product, int $id);

    //public function delete(int $id);

    public function addImages(Product $product,string $imagePath );

    public function addVariations(Product $product, $variations );
}
