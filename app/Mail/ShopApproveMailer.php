<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShopApproveMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $shop_details = "";
    public function __construct($shop_details)
    {
        $this->shop_details = $shop_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $shop_details = "";
        return $this->markdown('mailer.shopapprove', compact('shop_details'));
    }
}
