<?php

namespace App\Services\User;

interface UserService{
    public function register($email, $password);
    public function login($email, $password);
}