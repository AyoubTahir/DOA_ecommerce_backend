<?php

namespace App\Repositories\Category;


interface ICategoryRepository
{
    public function all(array $query);

    public function find(int $id);

    public function create(array $category);

    public function update(array $category, int $id);

    public function delete(int $id);
}
