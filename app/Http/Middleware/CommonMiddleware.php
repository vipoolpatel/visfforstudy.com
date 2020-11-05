<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CommonMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::check()) {
				return $next($request);
		} else {
			Auth::logout();
			return redirect(url('login'));
		}
	}
}
