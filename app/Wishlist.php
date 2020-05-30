<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function get_product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
