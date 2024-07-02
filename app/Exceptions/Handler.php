<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Dto\Dto;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            return Dto::error(Response::HTTP_NOT_FOUND, $e->getMessage());
        });

        $this->renderable(function (\Illuminate\Auth\AuthenticationException $e) {
            return Dto::error(Response::HTTP_UNAUTHORIZED, $e->getMessage());
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e) {
            return Dto::error(Response::HTTP_FORBIDDEN, $e->getMessage());
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\ConflictHttpException $e) {
            return Dto::error(Response::HTTP_CONFLICT, $e->getMessage());
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\BadRequestHttpException $e) {
            return Dto::error(Response::HTTP_BAD_REQUEST, $e->getMessage());
        });

        $this->renderable(function (Throwable $e) {
            Log::error('Message >>> : ' . $e->getMessage());

            return Dto::error(Response::HTTP_INTERNAL_SERVER_ERROR, 'Server error, please try again later');
        });
    }
}
