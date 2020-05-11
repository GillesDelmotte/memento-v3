<template>
  <div class="newSchedule">
    <div class="bgc__logo schedule"></div>
    <header-component title="Nouvel agenda"></header-component>
    <div
      class="newSchedule__explanation"
    >Bienvenu sur la page de création d'agenda. Vous trouverez ci-dessous sept encars qui correspondent aux sept jours de la semaine. Pour ajouter un jour à votre agenda, coché le bouton à droite du jour désiré et remplisez les heures souhaités. Vous pouvez créer plusieurs agendas différents mais les jour ne peuvent se retrouver que dans un seul agenda</div>
    <div class="newSchedule__days">
      <div :class="'newSchedule__day ' + day" v-for="day in days" :key="day">
        <div class="newSchedule__day__header">
          <div>{{day}}</div>
          <div class="radioButton">
            <input
              type="checkbox"
              v-on:change="openHours(day)"
              :name="day"
              :id="day"
              class="radioButton__input sr-only"
            />
            <label :for="day" class="radioButton__bgc">
              <label :for="day" class="radioButton__dot"></label>
            </label>
          </div>
        </div>
        <div class="newSchedule__day__hours">
          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Heures du début et fin de journée</div>
            <div class="newSchedule__day__hours__group__inputs">
              <input type="time" class="newSchedule__input" />
              <span class="newSchedule__sign"></span>
              <input type="time" class="newSchedule__input" />
            </div>
          </div>
          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Heures du début et fin du temps de midi</div>
            <div class="newSchedule__day__hours__group__inputs">
              <input type="time" class="newSchedule__input" />
              <span class="newSchedule__sign"></span>
              <input type="time" class="newSchedule__input" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="aside close">
      <div class="aside__close"></div>
      <h2 class="aside__title">Mes agendas</h2>
    </div>
    <div class="aside__button schedule" @click="openFilter"></div>
  </div>
</template>
<script>
export default {
  name: "CreateSchedule",
  data() {
    return {
      days: [
        "lundi",
        "mardi",
        "Mercredi",
        "jeudi",
        "vendredi",
        "samedi",
        "dimanche"
      ]
    };
  },
  methods: {
    openFilter() {
      const filter = document.querySelector(".aside");
      const nav = document.querySelector(".nav");
      nav.classList.remove("responsive__open");
      if (filter.classList.contains("close")) {
        filter.classList.remove("close");
      } else {
        filter.classList.add("close");
      }
    },
    openHours(day) {
      const hours = document.querySelector(".newSchedule__day." + day);
      if (hours.classList.contains("open")) {
        hours.classList.remove("open");
      } else {
        hours.classList.add("open");
      }
    }
  }
};
</script>
