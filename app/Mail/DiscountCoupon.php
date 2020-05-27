<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiscountCoupon extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $coupon_name    = "";
    public $valid_till     = "";
    public $customer_name  = "";
    public $discount       = "";
    public function __construct($coupon_name, $valid_till, $customer_name, $discount)
    {
       $this->coupon_name   = $coupon_name;
       $this->valid_till    = $valid_till;
       $this->customer_name = $customer_name;
       $this->discount      = $discount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $coupon_name   = "";
        $valid_till    = "";
        $customer_name = "";
        $discount      = "";
        return $this->view('mailer.coupon', compact('coupon_name', 'valid_till', 'customer_name', 'discount'));
    }
}
