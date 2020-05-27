@component('mail::message')
# Password Changed !!!
  
Your Password has been changed !!! 
If you did not change your password please visit the link below to reset your password.
Ignore this message if you are aware of the changes
   
@component('mail::button', ['url' => url('/password/reset')])
Reset Password
@endcomponent
   
Thanks,<br>
{{ config('app.name') }}
@endcomponent