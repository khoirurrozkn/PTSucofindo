<?php

namespace App\Http\Middleware;

use App\Models\PersonalAccessToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $findToken = PersonalAccessToken::where('token', $request->bearerToken())->first();

        if( !$findToken || !in_array($findToken['role'], $roles) || $findToken['user_id'] !== auth()->user()->id){
            throw new AccessDeniedHttpException("Unauthorized");
        }

        return $next($request);
    }
}
