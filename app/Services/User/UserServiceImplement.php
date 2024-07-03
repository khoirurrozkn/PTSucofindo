<?php

namespace App\Services\User;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserServiceImplement implements UserService{

    public function register($email, $password) :User {
        return User::create([
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }

    public function login($email, $password){
        $findUser = User::where('email', $email)->first();

        if( !$findUser || !Hash::check($password, $findUser['password'])){
            throw new BadRequestHttpException("Username - Email or Password is invalid");
        }
        
        $findUser['token'] = auth()->login($findUser);

        PersonalAccessToken::create([
            'user_id' => $findUser['id'],
            'token' => $findUser['token'],
            'role' => 'user'
        ]);

        return $findUser;
    }
}