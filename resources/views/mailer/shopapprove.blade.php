@component('mail::message')
# {{ $shop_details->shop_name }}
  
Congratulations !!! 
Your shop is now active. Now You can add your products and start selling.
   
@component('mail::button', ['url' => url('/shops')])
Visit Shop
@endcomponent
   
Thanks,<br>
{{ config('app.name') }}
@endcomponent