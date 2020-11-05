<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLanguageModel extends Model
{
    protected $table = 'user_language';

   public function getuserlanguage()
   {
      return $this->belongsTo(LanguageModel::class, "language_id");
   }
}
