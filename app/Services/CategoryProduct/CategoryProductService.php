<?php

namespace App\Services\CategoryProduct;

interface CategoryProductService{
    public function create($name);
    public function getWithPaginate();
    public function updateById($instanceModel, $name);
}