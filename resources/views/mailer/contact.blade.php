@component('mail::message')
# From    : {{ $name }}
# email   : {{ $email }}
# subject : {{ $subject }}

{{ $message }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent