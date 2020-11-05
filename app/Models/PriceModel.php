<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceModel extends Model
{
    protected $table = 'price';

    static public function getprice()
    {
      return self::get();
    }
}
