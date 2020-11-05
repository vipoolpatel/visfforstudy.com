<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    protected $table = 'booking';

    static public function getBooking()
    {
        return self::where('is_delete','=',0)->get();
    }
  
}
