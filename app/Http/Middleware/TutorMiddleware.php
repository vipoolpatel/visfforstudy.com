<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Session;

class TutorMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		
		if (Auth::check()) {
			if (Auth::user()->is_admin == 2 && !empty(Session::get('auth_token')) && (Session::get('auth_token') == Auth::user()->token)) {
					return $next($request);	
			} else {
				Auth::logout();
				return redirect(url('login'));
			}
		} else {
			Auth::logout();
			return redirect(url('login'));
		}
	}
}
