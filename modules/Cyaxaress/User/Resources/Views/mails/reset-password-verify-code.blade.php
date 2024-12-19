@component('mail::message')
# Your password reset code at Hemn_org

This email has been sent to you at your request to reset your password on the Hemn_org website. **If you did not make this request**, please ignore this email.

@component('mail::panel')
Your password reset code: {{ $code }}
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
