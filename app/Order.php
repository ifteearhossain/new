<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\Product;

class Order extends Model implements Product 
{ 
    use HasWallet;
    

    public function canBuy(Customer $customer, int $quantity = 1, bool $force = null): bool
    {
        /**
         * If the service can be purchased once, then
         *  return !$customer->paid($this);
         */
        return true; 
    }
  
    public function getAmountProduct(Customer $customer)
    {
        return request('total');
    }
  
    public function getMetaProduct(): ?array
    {
        return [
            'title' => 'Products Ordered', 
            'description' => 'Purchase of Product #' . request('id'),
        ];
    }

    public function getUniqueId(): string
    {
        return (string)$this->getKey();
    }

    protected $guarded = [];

    public function ordered_by()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function get_order_list()
    {
        return $this->hasMany('App\Order_list', 'order_id', 'id');
    }
}
