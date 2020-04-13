@extends('layouts.app')

@section('content')
<section class="welcome">
    <h1 class="welcome__title">Inscription</h1>
        <form method="POST" class="form" action="{{ route('register') }}">
            @csrf
            <div class="form__container">
                <div class="form__item">
                    <label for="name" class="form__item__label">Nom</label>
                    <input id="name" type="text" class="form__item__input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <div class="form__item__bgc"></div>
                    @error('name')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="email" class="form__item__label">Email</label>
                    <input id="email" type="email" class="form__item__input" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <div class="form__item__bgc"></div>
                    @error('email')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="password" class="form__item__label">Mot de passe</label>
                    <input id="password" type="password" class="form__item__input" name="password" required autocomplete="new-password">
                    <div class="form__item__bgc"></div>
                    @error('password')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="password-confirm" class="form__item__label">Confirmation mdp</label>
                    <input id="password-confirm" type="password" class="form__item__input" name="password_confirmation" required autocomplete="new-password">
                    <div class="form__item__bgc"></div>
                </div>
            </div>
            <button type="submit" class="btn">Inscription</button>
        </form>
</section>
@endsection
