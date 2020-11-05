<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReviewModel extends Model
{
    protected $table = 'user_review';


    public function getuser()
    {
	    return $this->belongsTo(UsersModel::class, "user_id");
    }

}
