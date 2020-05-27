@component('mail::message')
# New Shop Requests
  
Hello Admin,
Ekomalls has a new shop requests. Please visit the link to approve or decline the new shop.
If the shop is already approved/declined, Please ignore this email
   
@component('mail::button', ['url' => url('/shops')])
Review Shop Request
@endcomponent
   
Thanks,<br>
{{ config('app.name') }}
@endcomponent