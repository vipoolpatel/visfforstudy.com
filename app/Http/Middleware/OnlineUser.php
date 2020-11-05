<?php

namespace App\Http\Middleware;
use Auth;
use Cache;
use Carbon\Carbon;
use Closure;
use App\User;

class OnlineUser {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		$expirtime = Carbon::now()->addMinutes(3);
		if (!empty(Auth::user()->id)) {
			Cache::put('OnlineUser' . Auth::user()->id, true, $expirtime);	

            User::where('id','=',Auth::user()->id)->update(['updated_at' => (new \DateTime())->format("Y-m-d H:i:s")]);

			if(!empty(Cache::get('AvailabeOnline')))
	        {
	             $array_onlineuser = explode(',', Cache::get('AvailabeOnline'));
	             
	            if(in_array(Auth::user()->id, $array_onlineuser))
	            {
	                $user_id = Cache::get('AvailabeOnline');
	            }
	            else
	            {
	                $user_id = Cache::get('AvailabeOnline').','.Auth::user()->id;   
	            }
	             
	         }
	         else
	         {
	            $user_id = Auth::user()->id;
	         }
	         
	         Cache::put('AvailabeOnline',$user_id, $expirtime);
		}


		
		
		return $next($request);

	}
}
