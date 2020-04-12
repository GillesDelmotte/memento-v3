<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Memento - votre assistant de prise de rendez-vous</title>
    </head>
    <body>
        <section class="welcome">
            <h1 class="welcome__title">
                {{ config('app.name', 'Laravel') }}
            </h1>
            <div class="welcome__nav">
                <a href="{{ route('login') }}" class="welcome__nav__link">Connexion</a>
                <a href="{{ route('register') }}" class="welcome__nav__link">Inscription</a>
            </div>
        </section>
    </body>
</html>
