<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Memento - votre assistant de prise de rendez-vous</title>
    </head>
    <body>
        <div>
            <div>
                <h1>
                    Memento
                </h1>
                <div>
                    <a href="{{ route('login') }}">Connexion</a>
                    <a href="{{ route('register') }}">Inscription</a>
                </div>
            </div>
        </div>
    </body>
</html>
