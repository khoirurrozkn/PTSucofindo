<?php

namespace App\Http\Controllers;

use App\Dto\Dto;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductServiceImplement;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceImplement $productServiceImplement){
        $this->productService = $productServiceImplement;
    }

    public function create(ProductRequest $productRequest){
        $request = $productRequest->validated();

        $createdProduct = $this->productService->create(
            $request['product_category_id'],
            $request['name'],
            $request['price'],
            $request['image']
        );

        return Dto::success(
            Response::HTTP_CREATED, 
            "Success create product", 
            new ProductResource($createdProduct)
        );
    }

    public function getWithPaginate(){
        $paginate = $this->productService->getWithPaginate();

        return Dto::successWithPagination(
            ProductResource::collection($paginate->items()), 
            "Success get with paginate product", 
            $paginate
        );
    }

    public function getById(Product $product){
        return Dto::success(
            Response::HTTP_OK, 
            "Success get product", 
            new ProductResource($product)
        );
    }

    public function updateById(ProductRequest $productRequest, Product $product){
        $request = $productRequest->validated();

        $updatedData = $this->productService->updateById(
            $product,
            $request['product_category_id'],
            $request['name'],
            $request['price'],
            $request['image']
        );

        return Dto::success(
            Response::HTTP_OK, 
            "Success update product", 
            new ProductResource($updatedData)
        );
    }
}