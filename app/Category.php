<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $guarded = [];

   public function relationBetweenUser()
   {
     return $this->belongsTo('App\User', 'added_by', 'id');
   }

   public function getSubCategory()
   {
     return $this->hasMany('App\SubCategory', 'category_id', 'id');
   }
   public function productFromCategory()
   {
     return $this->hasMany('App\Product', 'category_id', 'id');
   }
}
