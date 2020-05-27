<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Traits\HasWalletFloat;
use Bavix\Wallet\Interfaces\WalletFloat;

class User extends Authenticatable implements MustVerifyEmail, Wallet, Customer, WalletFloat 
{
    use Notifiable;
    use HasWallet;
    use HasWalletFloat;
    use CanPay;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password', 
        'user_role', 
        'shop_id',
        'country_id',
        'state_id',
        'city_id', 
        'areacode',
        'address',
        'zip_code', 
        'phone_number', 
        'profile_picture',
        'provider_id',
        'provider',
        'access_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getshop()
    {
        return $this->hasOne('App\Shop');
    }
}
