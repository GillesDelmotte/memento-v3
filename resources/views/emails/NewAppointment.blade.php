@component('mail::message')
# Notification de votre rendez-vous

Bonjour {{$user->name}}, vous praticien {{$appointment->schedule->practitioner->name}} vient de vous ajouter dans son horaire.

Le rendez-vous se prestera le {{ \Carbon\Carbon::parse($appointment->date)->format('j F, Y') }} à {{$appointment->hour}}.

Si vous voulez changer ou supprimer le rendez-vous. cliqué sur le lien ci-dessous pour accéder à vos rendez-vous.

[aller sur mes rendez-vous]({{config('app.url')}})


Merci,<br>
{{ config('app.name') }}
@endcomponent
