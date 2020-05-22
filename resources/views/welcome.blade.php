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
            <div class="welcome__bgc">
                <img src="../images/calendar2.jpg" alt="">
            </div>
            <div class="welcome__container">
                <h1 class="welcome__title">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <p class="welcome__desc">
                    Votre assistant de prise de rendez-vous en ligne
                </p>
                <div class="welcome__nav">
                <a href="{{ route('login') }}" class="welcome__nav__link">Connexion</a>
                <a href="{{ route('register') }}" class="welcome__nav__link">Inscription</a>
            </div>
        </div>
        </section>
    </body>
</html>
