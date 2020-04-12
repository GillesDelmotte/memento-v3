@extends('layouts.app')

@section('content')
<section class="welcome">
    <h1 class="welcome__title">Connexion</h1>
    <form method="POST" class="form" action="{{ route('login') }}">
        @csrf
        <div class="form__container">
            <div class="form__item">
                <label for="email" class="form__item__label">Email</label>
                <input class="form__item__input" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="form__item__bgc"></div>
                @error('email')
                    <span class="form__item__error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form__item">
                <label for="password" class="form__item__label">Mot de passe</label>
                <input id="password" type="password" class="form__item__input" name="password" required autocomplete="current-password">
                <div class="form__item__bgc"></div>

                    @error('password')
                        <span class="form__item__error">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        </div>
        <button type="submit" class="btn">Connexion</button>
    </form>

</section>
@endsection
