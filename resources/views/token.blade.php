@extends('layouts.app')

@section('content')
<section class="welcome">
    <div class="welcome__bgc">
        <img src="../images/calendar2.jpg" alt="">
    </div>
    <div class="welcome__container">
        <a href="{{ url('/') }}" class="welcome__back" title="revenir à la page d'acceuil"><span class="sr-only">Revenir à la page d'accueil</span></a>
        <h1 class="welcome__title">Changer de mot de passe</h1>
        <p class="welcome__desc">
            Bonjour {{$user->name}}, Insérez votre nouveau mot de passe ci-dessous
        </p>
        <form method="POST" class="form" action="{{url('/changePassword')}}">
            @csrf
            <input type="hidden" name="email" value="{{$user->email}}">
            <input type="hidden" name="token" value="{{$user->token}}">
            <div class="form__container">
                <div class="form__item">
                    <label for="newPassword" class="form__item__label">Nouveau mot de passe</label>
                    <input id="newPassword" type="password" placeholder="8 caractères minimum" class="form__item__input" name="newPassword" required>
                    <div class="form__item__bgc"></div>
                    @if($error)
                        <span class="form__item__error">
                            <strong>{{ $error }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__item">
                    <label for="password-confirm" class="form__item__label">Confirmation mdp</label>
                    <input id="password-confirm" type="password" placeholder="8 caractères minimum" class="form__item__input" name="password_confirmation" required autocomplete="new-password">
                    <div class="form__item__bgc"></div>
                </div>
            </div>
            <button type="submit" class="btn">Changer mon mot de passe</button>
        </form>
    </div>
</section>
@endsection
