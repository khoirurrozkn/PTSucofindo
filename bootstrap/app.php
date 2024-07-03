<?php

use App\Dto\Dto;
use App\Http\Middleware\CheckRole;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkRole' => CheckRole::class 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return Dto::error(Response::HTTP_NOT_FOUND, $e->getMessage());
        });

        $exceptions->renderable(function (AuthenticationException $e) {
            return Dto::error(Response::HTTP_UNAUTHORIZED, $e->getMessage());
        });

        $exceptions->renderable(function (AccessDeniedHttpException $e) {
            return Dto::error(Response::HTTP_FORBIDDEN, $e->getMessage());
        });

        $exceptions->renderable(function (ConflictHttpException $e) {
            return Dto::error(Response::HTTP_CONFLICT, $e->getMessage());
        });

        $exceptions->renderable(function (BadRequestHttpException $e) {
            return Dto::error(Response::HTTP_BAD_REQUEST, $e->getMessage());
        });

        $exceptions->renderable(function (Throwable $e) {
            Log::error('Error : '. $e->getMessage());

            return Dto::error(Response::HTTP_INTERNAL_SERVER_ERROR, 'Server error, please try again later');
        });
    })->create();
