@extends('layouts.app')

@section('content')
<section class="welcome">
    <div class="welcome__bgc">
        <img src="../images/calendar2.jpg" alt="">
    </div>
    <div class="welcome__container">
        <a href="{{ url('/') }}" class="welcome__back" title="revenir à la page d'acceuil"><span class="sr-only">Revenir à la page d'accueil</span></a>
        <h1 class="welcome__title">Memento</h1>
        @if($user)
            <p class="welcome__success">Votre compte à bien été supprimé</p>
        @else
            <p class="welcome__success">Ce compte à déjà été supprimé.</p>
        @endif
    </div>
</section>
@endsection
