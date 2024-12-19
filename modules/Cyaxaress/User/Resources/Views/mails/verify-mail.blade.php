@component('mail::message')
# Your account activation code at Hemn_org

This email has been sent to you because you registered on the Hemn_org website. **If you did not register**, please ignore this email.

@component('mail::panel')
Your activation code: {{ $code }}
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
