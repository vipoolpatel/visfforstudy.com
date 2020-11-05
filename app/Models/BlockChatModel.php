<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockChatModel extends Model
{
    protected $table = 'block_chat';

    static public function get_block_chat() {
 		return self::get();
    }
    
}
