@component('mail::message')
Hi {{ $user->name }},

<p>Thanks for Joining {{ config('app.name') }}.</p>

<p>Cick on the link bellow, to Validate your email address.</p>

@component('mail::button', ['url' => url('activate/'.$user->remember_token)])
Verify
@endcomponent

Thanks,<br>
VISFFOR TEAM
@endcomponent