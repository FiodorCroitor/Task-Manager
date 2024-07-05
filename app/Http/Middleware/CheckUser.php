<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckUser
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var User|null $user
         */
        $user = Auth::guard('web')->user();
        if ($user === null || !$user->active) {
            throw new AccessDeniedHttpException(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
