@extends('layouts.app')

@section('content')
<section class="welcome">
    <div class="welcome__bgc">
                <img src="../images/calendar2.jpg" alt="">
            </div>
    <div class="welcome__container">
        <a href="{{ url('/') }}" class="welcome__back" title="revenir à la page d'acceuil"><span class="sr-only">Revenir à la page d'accueil</span></a>
        <h1 class="welcome__title">Inscription</h1>
        <form method="POST" class="form" action="{{ route('register') }}">
            @csrf
            <div class="form__container">
                <div class="form__item">
                    <label for="name" class="form__item__label">Nom</label>
                    <input id="name" autocomplete="off" type="text" placeholder="Jean Pierre" class="form__item__input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <div class="form__item__bgc"></div>
                    @error('name')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="email" class="form__item__label">Email</label>
                    <input id="email" autocomplete="off" type="email" placeholder="jean.pierre@gmail.com" class="form__item__input" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <div class="form__item__bgc"></div>
                    @error('email')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="password" class="form__item__label">Mot de passe</label>
                    <input id="password" type="password" placeholder="8 caractères minimum" class="form__item__input" name="password" required autocomplete="new-password">
                    <div class="form__item__bgc"></div>
                    @error('password')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="password-confirm" class="form__item__label">Confirmation mdp</label>
                    <input id="password-confirm" type="password" placeholder="8 caractères minimum" class="form__item__input" name="password_confirmation" required autocomplete="new-password">
                    <div class="form__item__bgc"></div>
                </div>
            </div>
            <button type="submit" class="btn">Inscription</button>
        </form>
    </div>
</section>
@endsection
