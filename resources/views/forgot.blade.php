@extends('layouts.app')

@section('content')
<section class="welcome">
    <div class="welcome__bgc">
        <img src="../images/calendar2.jpg" alt="">
    </div>
    <div class="welcome__container">
        <a href="{{ url('/') }}" class="welcome__back" title="revenir à la page d'acceuil"><span class="sr-only">Revenir à la page d'accueil</span></a>
        <h1 class="welcome__title">Mot de passe oublié</h1>
        <p class="welcome__desc">
            Bonjour, veuillez entrer votre email pour recevoir un lien pour changer de mot de passe. Si vous avez deja recu un email comportant un token, entrer aussi le token
        </p>
        @if($success)
        <p class="welcome__success">Un Email été envoyé sur l'adresse "{{$userEmail}}"</p>
        @endif
        <form method="POST" class="form" action="{{url('/createToken')}}">
            @csrf
            <div class="form__container">
                <div class="form__item">
                    <label for="email" class="form__item__label">Email*</label>
                    <input id="email" type="email" value="{{$lastEmail}}" placeholder="Jean.charles@outlook.be" class="form__item__input" name="email" required>
                    <div class="form__item__bgc"></div>
                    @if($emailError !== '')
                        <span class="form__item__error">
                            <strong>{{ $emailError }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="token" class="form__item__label">Token</label>
                    <input id="token" type="text" name="token" class="form__item__input" placeholder="GswvlNWCF2rgklRjTgBcIWE3QqMpqpl8">
                    <div class="form__item__bgc"></div>
                </div>
            </div>
            <button type="submit" class="btn">Envoyer</button>
        </form>
    </div>
</section>
@endsection
