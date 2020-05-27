<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['sub_category_name', 'category_id'];

    public function relationBetweenCategory()
    {
      return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getproduct()
    {
      return $this->hasMany('App\Product');
    }
}
