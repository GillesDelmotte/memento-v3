@component('mail::message')
# Suppression de votre rendez-vous

Bonjour {{$user->name}}, vous praticien {{$appointment->schedule->practitioner->name}} vient de supprimer votre rendez-vous du {{ \Carbon\Carbon::parse($appointment->date)->format('j F, Y') }} à {{$appointment->hour}}.

Si vous voulez reprendre rendez-vous avec {{$appointment->schedule->practitioner->name}} n'hésitez pas à cliquer sur le lien ci-dessous

[aller sur Memento]({{config('app.url')}})


Merci,<br>
{{ config('app.name') }}
@endcomponent
