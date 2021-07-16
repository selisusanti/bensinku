@component('mail::message')
Hello **{{$name}}**,  
Please click the button below to reset your password.

@component('mail::button', ['url' => $link])
Reset Password
@endcomponent
Sincerely,
Bensinku
{{ $link }}
@endcomponent