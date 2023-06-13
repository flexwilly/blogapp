<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Subscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect('/');
        }

        //get current logged in user
        $user=Auth::user();

        //if user is subscriber handle the request
        if($user->role === 3){
            return $next($request);
        }

        //if its an admin go to admin dashboard page
        if($user->role === 1){
            return redirect('/admin/users');
        }

        //a author  has the id of 2
        if($user->role === 2){
            return redirect('/articles');
        }

    }
}
