<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   protected $guarded = [];

   public function cartProduct()
   {
    return $this->belongsTo('App\Product', 'product_id', 'id');
   }

}   
