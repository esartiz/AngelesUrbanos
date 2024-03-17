<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AngelesUrbanos
{
    public function handle($request, Closure $next)
{
    $user = 'giovanni';
    $password = 'Rupertosky24-';

    if ($request->getUser() != $user || $request->getPassword() != $password) {
        $headers = ['WWW-Authenticate' => 'Basic'];
        return response('Unauthorized', 401, $headers);
    }

    return $next($request);
}

}
