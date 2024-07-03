<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductServiceImplement implements ProductService{

    public function create($productCategoryId, $name, $price, $image){
        return Product::create([
            'product_category_id' => $productCategoryId,
            'name' => $name,
            'price' => $price,
            'image' => $image
        ]);
    }

    public function getWithPaginate(){
        return Product::paginate(10);
    }

    public function updateById($instanceModel, $productCategoryId, $name, $price, $image){
        $instanceModel->update([
            'product_category_id' => $productCategoryId,
            'name' => $name,
            'price' => $price,
            'image' => $image
        ]);

        return $instanceModel;
    }
}