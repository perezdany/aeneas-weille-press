@component('mail::message')
# A ne pas répondre!
	
Merci de ne pas répondre à ce mail.

Bonjour cher client, veuillez cliquer sur le bouttn pour procéder à la réinitialisation de votre mot de passe:

@component('mail::button', ['url' => $data['url'], 'color' => 'primary'])
Valider
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
