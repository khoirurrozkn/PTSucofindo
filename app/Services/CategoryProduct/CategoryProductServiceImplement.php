<?php

namespace App\Services\CategoryProduct;

use App\Models\CategoryProduct;

class CategoryProductServiceImplement implements CategoryProductService{

    public function create($name){
        return CategoryProduct::create([
            'name' => $name,
        ]);
    }

    public function getWithPaginate(){
        return CategoryProduct::paginate(10);
    }

    public function updateById($instanceModel, $name){
        $instanceModel->update([
            'name' => $name
        ]);

        return $instanceModel;
    }
}