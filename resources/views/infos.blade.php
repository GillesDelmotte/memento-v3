@extends('layouts.app')

@section('content')
<div>
    <div class="header">
        <div class="header__logo">M</div>
        <h1 class="header__title">Informations</h1>
    </div>
    <div class="infos">
        <div class="infos__container">
            <section class=" infos__section">
                <h2 class="infos__section__title">Qu'est ce que Memento ?</h2>
                 <div class="infos__section__overflow">
                    <img src="../images/welcome.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <p>
                            Memento est une application de prise de rendez-vous en ligne qui reprend toutes sortes de praticiens ( Médecin, coiffeur, esthéticien, etc... ) dans l'ensemble de la belgique.
                        </p>
                    </div>
                </div>
            </section>
            <section class="infos__section">
                <h2 class="infos__section__title">Comment fonctionne Memento ?</h2>
                <div class="infos__section__overflow">
                    <img src="../images/meet.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <h3>Mes rendez-vous</h3>
                        <p>
                            Sur cette page, vous retrouverez tous les rendez-vous que vous avez pris sur l'application et qui ne sont pas encore passé dans le temps.
                        </p>
                    </div>
                </div>
                <div class="infos__section__overflow">
                    <img src="../images/praticiens.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <h3>Les praticiens</h3>
                        <p>
                            Ici, vous avez une liste de tous les praticiens qui se trouve dans votre région grâce à la géolocalisation. si vous voulez changer d'endroit, vous pouvez indiqué le code postale que vous souhaité dans le champs de recherche <b>(n°1)</b>. Si l'endroit vous convient, vous pouvez filtrer les praticiens par nom ou par profession grâce à l'encars a droite <b>(n°2)</b>.
                        </p>
                    </div>
                </div>
                <div class="infos__section__overflow">
                    <img src="../images/praticien.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <h3>Le profil d'un praticien</h3>
                        <p>
                            Quand vous avez choisis votre praticien, vous arrivez sur sa page de profil. Vous y retrouverez ses informations personnelles <b>(n°1)</b>, son/ses agenda(s) <b>(n°2)</b> et un espace commentaire <b>(n°3)</b>. N'hésitez pas à revenir sur le profil après votre rendez-vous pour donner un avis sur le praticien.
                        </p>
                    </div>
                </div>
                <div class="infos__section__overflow">
                    <img src="../images/praticienSchedule.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <h3>L'agenda d'un praticien</h3>
                        <p>
                            Quand vous êtes sur l'agenda d'un praticien, vous avez à droite son nom, l'agenda sur lequel vous vous trouvez et le calendrier <b>(n°1)</b>. Les jours en surbrillance sont ceux ou il y a possibilité de prendre un rendez-vous. Pour prendre rendez-vous ? Rien de plus simple, il suffit de cliqué sur une case "Plage horaire disponible" <b>(n°2)</b>. Quand cela est fait, la case ce changera en vert avec votre nom <b>(n°3)</b>. Si il n'y a pas de case, cela veut dire que l'heure est déjà reservée.
                        </p>
                    </div>
                </div>
                <div class="infos__section__overflow">
                    <img src="../images/myProfile.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <h3>Mon profil</h3>
                        <p>
                            Ici ce trouve votre profil. vous y retrouverez vos informations personnelles que vous pouvez modifier en cliquant sur cette icone <b>(n°1)</b>. Un bouton qui, quand il est activé, index votre profil dans la liste des praticiens <b>(n°2)</b>. Un espace avec les commentaires laissés sur votre profil <b>(n°3)</b> et à droite, votre/vos agenda(s) avec en dessous du nom les jours présents dans cette agenda <b>(n°4)</b>.
                        </p>
                    </div>
                </div>
                <div class="infos__section__overflow">
                    <img src="../images/create.png" alt="" class="infos__section__img">
                    <div class="infos__section__content">
                        <h3>Mon profil</h3>
                        <p>
                            Lorsque vous êtes dans la création d'un agenda. Pour chaque jour, vous pouvez spécifier des heures et des plages horaires différentes <b>(n°1)</b>. Cependant, un jour ne peux se retrouver que dans un seul agenda. Si vous voulez que tous les jours aie les même heures et plage horaire, vous pouvez cliqué sur le bouton en bas a droite <b>(n°2)</b>.
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
@endsection
