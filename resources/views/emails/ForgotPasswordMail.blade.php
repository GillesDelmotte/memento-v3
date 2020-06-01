@component('mail::message')
# Mot de passe oublié

Bonjour {{$user->name}}, vous avez demandé pour changer de mot de passe. Cliqué sur le lien ci-dessous pour continué le processus

[Changer de mot de passe]({{config('app.url')}}/verifyToken/{{$user->token}})

Merci,<br>
{{ config('app.name') }}
@endcomponent
