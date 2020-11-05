@component('mail::message')
Hi, {{$user->name}}. Forgot Your Password?

<p>It happens. Click the link below to reset your password.</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent


! in case you have any issue recovering your password, please contact us using the form from contact us page
<br />
Thanks,<br>
VISFFOR TEAM
@endcomponent