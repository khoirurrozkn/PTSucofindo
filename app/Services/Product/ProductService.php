<?php

namespace App\Services\Product;

interface ProductService{
    public function create($productCategoryId, $name, $price, $image);
    public function getWithPaginate();
    public function updateById($instanceModel, $productCategoryId, $name, $price, $image);
    public function deleteById($instanceModel);
}