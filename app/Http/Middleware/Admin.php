<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //if the user is not logged in take them back to login
        if(!Auth::check()){
            return redirect('/login');
        }

        //get current logged in user
        $user=Auth::user();

        //if user is admin handle the request
        if($user->role === 1){
            return $next($request);
        }

        //if its an author go to author index page
        if($user->role === 2){
            return redirect('/articles');
        }

        //a subscriber has the id of 3
        if($user->role === 3){
            return redirect('/');
        }


    }
}
