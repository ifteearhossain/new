<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    protected $guarded = [];
   public function get_product_info_via_order_list()
   {
       return $this->belongsTo('App\Product', 'product_id', 'id');
   }
}
