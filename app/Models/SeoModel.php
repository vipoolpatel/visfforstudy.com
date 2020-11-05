<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoModel extends Model
{
    protected $table = 'seo';

    static public function getseo($slug) {
    	return self::where('slug','=',$slug)->first();
    }

}
