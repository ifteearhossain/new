<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getsubcategory()
    {
        return $this->belongsTo('App\SubCategory', 'sub_category_id', 'id');
    }
    public function getmultipleimage()
    {
        return $this->hasMany('App\ProductMultipleImage');
    }
    public function getshop()
    {
        return $this->hasOne('App\Shop', 'id', 'shop_id');
    }
    public function get_order_list()
    {
        return $this->hasMany('App\Order_list', 'product_id', 'id');
    }
}
