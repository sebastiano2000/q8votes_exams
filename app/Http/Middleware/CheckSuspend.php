<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuspend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->suspend == 1){
            auth()->logout();

            $message = __('auth.this_account_is_suspended');

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
