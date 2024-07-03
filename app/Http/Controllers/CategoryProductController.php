<?php

namespace App\Http\Controllers;

use App\Dto\Dto;
use App\Http\Requests\CategoryProductRequest;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;
use App\Services\CategoryProduct\CategoryProductServiceImplement;
use Symfony\Component\HttpFoundation\Response;

class CategoryProductController extends Controller
{
    private $categoryProductService;

    public function __construct(CategoryProductServiceImplement $categoryProductServiceImplement){
        $this->categoryProductService = $categoryProductServiceImplement;
    }

    public function create(CategoryProductRequest $categoryProductRequest){
        $request = $categoryProductRequest->validated();

        $createdCategoryProduct = $this->categoryProductService->create(
            $request['name']
        );

        return Dto::success(
            Response::HTTP_CREATED, 
            "Success create category product", 
            new CategoryProductResource($createdCategoryProduct)
        );
    }

    public function getWithPaginate(){
        $paginate = $this->categoryProductService->getWithPaginate();

        return Dto::successWithPagination(
            CategoryProductResource::collection($paginate->items()), 
            "Success get with paginate category product", 
            $paginate
        );
    }

    public function getById(CategoryProduct $categoryProduct){
        return Dto::success(
            Response::HTTP_OK, 
            "Success get category product", 
            new CategoryProductResource($categoryProduct)
        );
    }

    public function updateById(CategoryProductRequest $categoryProductRequest, CategoryProduct $categoryProduct){
        $request = $categoryProductRequest->validated();

        $updatedData = $this->categoryProductService->updateById(
            $categoryProduct,
            $request['name']
        );

        return Dto::success(
            Response::HTTP_OK, 
            "Success update category product", 
            new CategoryProductResource($updatedData)
        );
    }

    public function deleteById(CategoryProduct $categoryProduct){
        $deletedData = $this->categoryProductService->deleteById($categoryProduct);

        return Dto::success(
            Response::HTTP_OK, 
            "Success delete category product", 
            null
        );
    }
}