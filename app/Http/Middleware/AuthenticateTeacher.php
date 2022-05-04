<?php namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class AuthenticateTeacher extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        $token = $request->query('api_token');
        if(empty($token)){
            $token = $request->input('api_token');
        }
        if(empty($token)){
            $token = $request->bearerToken();
        }

        if($token === 'a23ew9dosTeacher21apksfjnsdjlk') return;
        $this->unauthenticated($request, $guards);
    }
}
