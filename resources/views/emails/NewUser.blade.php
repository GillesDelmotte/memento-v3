@component('mail::message')
# Notification de votre rendez-vous

Bonjour {{$user->name}}, vous venez de prendre rendez-vous avec {{$appointment->schedule->practitioner->name}}.

Le rendez-vous se prestera le {{ \Carbon\Carbon::parse($appointment->date)->format('j F, Y') }} à {{$appointment->hour}}

vous n'êtes pas encore inscrit au sein de l'application Memento ?

N'attendez plus! Votre compte à déjà été créé. Cliqué sur le lien ci-dessous pour finialiser votre inscritpion. Il ne vous reste plus qu'à entré un mot de passe!

[Finalisez mon inscription]({{config('app.url')}}/verifyToken/{{$user->token}})

Cependant, si vous ne voulez pas faire partie de l'aventure avec nous, cliqué sur le lien ci-dessous pour supprimer votre compte. Votre rendez-vous sera malgré tout concervé.

[Supprimez mon compte]({{config('app.url')}}/deleteProfil/{{$user->token}})

Merci,<br>
{{ config('app.name') }}
@endcomponent
