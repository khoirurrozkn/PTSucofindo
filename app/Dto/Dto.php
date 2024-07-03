<?php

namespace App\Dto;
use Symfony\Component\HttpFoundation\Response;

class Dto{

    public static function success($code, $description, $data){
        return response()->json([
            'status' => [
                'code' => $code,
                'description' => $description
            ],
            'data' => $data
        ], $code);
    }

    public static function error($code, $description){
        return response()->json([
            'status' => [
                'code' => $code,
                'description' => $description
            ]
        ], $code);
    }

    public static function errorWithMessage($code, $message, $errors){
        return response()->json([
            "status" => [
                "code" => $code,
                "description" => $message
            ],
            "errors" => $errors
        ], $code);
    }
}