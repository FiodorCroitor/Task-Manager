<?php

namespace App\Http\Middleware;

use App\Repository\User\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckPermission
{
    public function handle(Request $request, Closure $next): Response
    {
/*
        $user = Auth::user();
        $routeName = $request->route()->getName();
        if($user === null || $routeName === null)
        {
            throw  new AccessDeniedHttpException('Access Denied' , null , Response::HTTP_FORBIDDEN);
        }
*/
        return $next($request);
    }
}
