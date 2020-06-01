@component('mail::message')
# Notification de votre rendez-vous

Bonjour {{$user->name}}, vous venez de prendre rendez-vous avec {{$appointment->schedule->practitioner->name}}.

Le rendez-vous se prestera le {{ \Carbon\Carbon::parse($appointment->date)->format('j F, Y') }} à {{$appointment->hour}}

Grâce à ce rendez-vous, un compte sur l'application {{ config('app.name') }} à été créé. Si vous ne voulez plus recevoir de notification, finalisez votre inscription en suivant le lien ci-dessous.
Dans l'onglet "Mon profil" vous pourrez les désactiver.

[finalisez mon inscription]({{config('app.url')}}/verifyToken/{{$user->token}})

Merci,<br>
{{ config('app.name') }}
@endcomponent
