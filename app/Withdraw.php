<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
   protected $guarded = [];

   public function getuser()
   {
      return $this->belongsTo('App\User', 'user_id', 'id');
   }
}
