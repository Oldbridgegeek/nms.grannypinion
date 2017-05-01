<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Request;
use App\User;

class InteractingWithYourself
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Auth::check())
        {
            $user_id = Request::segment(1);
            $user = User::where('id', $user_id)->first();
            if(Auth::user()->id == $user->id)
            {
                return redirect()->route('user.show',['user'=>$user->id]);
            }
        }
        return $next($request);
    }
}
