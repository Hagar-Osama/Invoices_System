<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user()->status;
        if($user === 'active') {
            return $next($request);
        }
        session()->flash('error', 'You Cant Login For Now');
        return redirect(route('signinpage'));
    }
}
