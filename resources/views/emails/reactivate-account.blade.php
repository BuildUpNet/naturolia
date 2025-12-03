@component('mail::message')
# Reactivate Your Account

Your account is deactivated. Click the button below to reactivate your account.  

This link will expire in **10 minutes**.

@component('mail::button', ['url' => $url])
Reactivate Account
@endcomponent

If you did not request this, please ignore this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
