<?php

namespace App\Http\Controllers;

use App\Dto\Dto;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\User\UserServiceImplement;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceImplement $userServiceImplement){
        $this->userService = $userServiceImplement;
    }

    public function register(UserRegisterRequest $userRegister){
        $request = $userRegister->validated();

        $createdUser = $this->userService->register(
            $request['email'],
            $request['password']
        );

        return Dto::success(
            Response::HTTP_CREATED, 
            "Success create user", 
            new UserResource($createdUser)
        );
    }

    public function login(UserLoginRequest $userLogin){
        $request = $userLogin->validated();

        $loginedUser = $this->userService->login(
            $request['email'],
            $request['password']
        );

        return Dto::success(
            Response::HTTP_OK, 
            "Success login user", 
            new UserResource($loginedUser)
        );
    }
}