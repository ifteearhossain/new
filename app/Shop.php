<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [];

    public function getproduct()
    {
        return $this->hasMany('App\Product');
    }
    public function getowner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
