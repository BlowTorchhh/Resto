<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $rules)
    {
        if(!Auth::check()){
            return redirect()->url('login');
        }

        $user = Auth::user();
        if($user->id_role == $rules){
            return $next($request);
        }
        if ($user->id_role != $rules) {
            return redirect('login');
        }
        return redirect('/');
    }
}
