@extends('layouts.app')

@section('content')
<section class="welcome">
    <div class="welcome__bgc">
        <img src="../images/calendar2.jpg" alt="">
    </div>
    <div class="welcome__container">
        <a href="{{ url('/') }}" class="welcome__back" title="revenir à la page d'acceuil"><span class="sr-only">Revenir à la page d'accueil</span></a>
        <h1 class="welcome__title">Connexion</h1>
        <form method="POST" class="form" action="{{ route('login') }}">
            @csrf
            <div class="form__container">
                <div class="form__item">
                    <label for="email" class="form__item__label">Email</label>
                    <input class="form__item__input" autocomplete="off" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="jean.pierre@gmail.com">
                    <div class="form__item__bgc"></div>
                    @error('email')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="password" class="form__item__label">Mot de passe</label>
                    <input id="password" type="password" placeholder="8 caractères minimum" class="form__item__input" name="password" required>
                    <div class="form__item__bgc"></div>

                        @error('password')
                            <span class="form__item__error">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
            <div class="welcome__buttons">
                <button type="submit" class="btn">Connexion</button>
                <a href="" class="forgotPassword">Mot de passe oublié</a>
            </div>
        </form>
    </div>
</section>
@endsection
