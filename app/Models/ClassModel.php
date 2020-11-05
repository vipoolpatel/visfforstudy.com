<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';

    static public function getClass()
    {
        return self::get();
    }
    
}
