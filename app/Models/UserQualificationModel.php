<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQualificationModel extends Model
{
    protected $table = 'user_qualification';

    static public function getQulification()
    {
        return self::get();
    }
}
