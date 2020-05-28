<template>
  <div class="newSchedule">
    <div class="bgc__logo schedule"></div>
    <header-component title="Nouvel agenda"></header-component>
    <div class="newSchedule__choice" v-if="choice === null && days.length !== 0">
      <p>Voulez-vous avoir le même horaire pour chaque jour ?</p>
      <div class="newSchedule__choice__buttons">
        <button @click="makeMyCHoice('same')">Oui, je le veux</button>
        <button @click="makeMyCHoice('differents')">Non, je ne veux pas</button>
      </div>
    </div>
    <div
      class="newSchedule__explanation"
      v-if="choice === 'differents'"
    >Bienvenu sur la page de création d'agenda. Vous trouverez ci-dessous sept encars qui correspondent aux sept jours de la semaine. Pour ajouter un jour à votre agenda, coché le bouton à droite du jour désiré et remplisez les heures souhaités. Vous pouvez créer plusieurs agendas différents mais les jours ne peuvent se retrouver que dans un seul agenda</div>
    <p class="newSchedule__error" v-if="findError('emptyDay')">{{findError("emptyDay")}}</p>
    <div class="newSchedule__days" v-if="days.length !== 0 && choice === 'differents'">
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
            <div class="newSchedule__day__hours__title">Durée des rendez-vous</div>
            <div class="newSchedule__day__hours__group__radio">
              <div class="radios">
                <input
                  type="radio"
                  :name="'timer-' + day"
                  :id="'timer15-' + day "
                  value="15"
                  checked
                  class="sr-only"
                />
                <label :for="'timer15-' + day" class="radios__dot"></label>
                <label :for="'timer15-' + day" class="radios__label">15minutes</label>
              </div>
              <div class="radios">
                <input
                  type="radio"
                  :name="'timer-' + day"
                  :id="'timer30-' + day "
                  value="30"
                  class="sr-only"
                />
                <label :for="'timer30-' + day" class="radios__dot"></label>
                <label :for="'timer30-' + day" class="radios__label">30minutes</label>
              </div>
              <div class="radios">
                <input
                  type="radio"
                  :name="'timer-' + day"
                  :id="'timer45-' + day "
                  value="45"
                  class="sr-only"
                />
                <label :for="'timer45-' + day" class="radios__dot"></label>
                <label :for="'timer45-' + day" class="radios__label">45minutes</label>
              </div>
              <div class="radios">
                <input
                  type="radio"
                  :name="'timer-' + day"
                  :id="'timer60-' + day "
                  value="60"
                  class="sr-only"
                />
                <label :for="'timer60-' + day" class="radios__dot"></label>
                <label :for="'timer60-' + day" class="radios__label">60minutes</label>
              </div>
            </div>
          </div>
          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Heures du début et fin de la matinée</div>
            <div class="newSchedule__day__hours__group__inputs">
              <input type="time" class="newSchedule__input" :id="'ms-' + day" />
              <span class="newSchedule__sign"></span>
              <input type="time" class="newSchedule__input" :id="'me-' + day" />
            </div>
          </div>
          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Heures du début et fin de l'après-midi</div>
            <div class="newSchedule__day__hours__group__inputs">
              <input type="time" class="newSchedule__input" :id="'as-' + day" />
              <span class="newSchedule__sign"></span>
              <input type="time" class="newSchedule__input" :id="'ae-' + day" />
            </div>
          </div>
          <p class="newSchedule__error" v-if="findError(day)">{{findError(day)}}</p>
        </div>
      </div>
    </div>
    <div class="newSchedule__days" v-if="days.length !== 0 && choice === 'same'">
      <div class="newSchedule__day open">
        <div class="newSchedule__day__hours">
          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Durée des rendez-vous</div>
            <div class="newSchedule__day__hours__group__radio">
              <div class="radios">
                <input type="radio" name="timer" id="timer15" value="15" checked class="sr-only" />
                <label for="timer15" class="radios__dot"></label>
                <label for="timer15" class="radios__label">15minutes</label>
              </div>
              <div class="radios">
                <input type="radio" name="timer" id="timer30" value="30" class="sr-only" />
                <label for="timer30" class="radios__dot"></label>
                <label for="timer30" class="radios__label">30minutes</label>
              </div>
              <div class="radios">
                <input type="radio" name="timer" id="timer45" value="45" class="sr-only" />
                <label for="timer45" class="radios__dot"></label>
                <label for="timer45" class="radios__label">45minutes</label>
              </div>
              <div class="radios">
                <input type="radio" name="timer" id="timer60" value="60" class="sr-only" />
                <label for="timer60" class="radios__dot"></label>
                <label for="timer60" class="radios__label">60minutes</label>
              </div>
            </div>
          </div>
          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Heures du début et fin de la matinée</div>
            <div class="newSchedule__day__hours__group__inputs">
              <input type="time" class="newSchedule__input" id="ms" />
              <span class="newSchedule__sign"></span>
              <input type="time" class="newSchedule__input" id="me" />
            </div>
          </div>

          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Heures du début et fin de l'après-midi</div>
            <div class="newSchedule__day__hours__group__inputs">
              <input type="time" class="newSchedule__input" id="as" />
              <span class="newSchedule__sign"></span>
              <input type="time" class="newSchedule__input" id="ae" />
            </div>
          </div>

          <div class="newSchedule__day__hours__group">
            <div class="newSchedule__day__hours__title">Selectionnez les jours nécésaires</div>
            <div class="newSchedule__day__hours__group__days">
              <div class="day" v-for="day in days" :key="day">
                <div class="radioButton">
                  <input
                    type="checkbox"
                    name="day"
                    :id="day"
                    :value="day"
                    class="radioButton__input sr-only radioButton__day"
                  />
                  <label :for="day" class="radioButton__bgc">
                    <label :for="day" class="radioButton__dot"></label>
                  </label>
                </div>
                <label :for="day" class="label">{{day}}</label>
              </div>
            </div>
          </div>
          <p class="newSchedule__error" v-if="findError('same')">{{findError('same')}}</p>
        </div>
      </div>
    </div>
    <div v-if="days.length === 0" class="newSchedule__fulltime">vous n'avez plus de jour libre</div>
    <div :class="'aside close ' + currentUser.theme" v-if="days.length !== 0 && choice !== null">
      <div class="aside__close"></div>
      <h2 class="aside__title">Nom de l'agenda</h2>
      <input
        type="text"
        name="scheduleName"
        id="scheduleName"
        class="filter__input"
        autocomplete="off"
        placeholder="Nom de l'agenda"
      />
      <div class="aside__scheduleColors">
        <input
          type="radio"
          class="sr-only aside__scheduleColors__input"
          name="color"
          id="red"
          value="red"
          checked
        />
        <label class="scheduleColor red" for="red"></label>

        <input
          type="radio"
          class="sr-only aside__scheduleColors__input"
          name="color"
          id="blue"
          value="blue"
        />
        <label class="scheduleColor blue" for="blue"></label>

        <input
          type="radio"
          class="sr-only aside__scheduleColors__input"
          name="color"
          id="yellow"
          value="yellow"
        />
        <label class="scheduleColor yellow" for="yellow"></label>

        <input
          type="radio"
          class="sr-only aside__scheduleColors__input"
          name="color"
          id="green"
          value="green"
        />
        <label class="scheduleColor green" for="green"></label>

        <input
          type="radio"
          class="sr-only aside__scheduleColors__input"
          name="color"
          id="purple"
          value="purple"
        />
        <label class="scheduleColor purple" for="purple"></label>
      </div>
      <p class="aside__error" v-if="findError('name')">{{findError("name")}}</p>
      <a
        class="aside__link save"
        @click="createSchedule"
        v-if="choice === 'differents'"
      >Sauvegarder mon horaire</a>
      <a
        class="aside__link save"
        @click="createScheduleSameHour"
        v-if="choice === 'same'"
      >Sauvegarder mon horaire</a>
    </div>
    <div
      class="aside__button schedule"
      @click="openFilter"
      v-if="days.length !== 0 && choice !== null"
    ></div>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import router from "../router.js";
import { mapMutations } from "vuex";

export default {
  name: "CreateSchedule",
  data() {
    return {
      errors: [],
      choice: null
    };
  },
  computed: {
    ...mapState(["currentUser"]),
    days() {
      var oldDays = [];
      var alldays = [
        "lundi",
        "mardi",
        "mercredi",
        "jeudi",
        "vendredi",
        "samedi",
        "dimanche"
      ];
      this.currentUser.schedules.forEach(function(schedule) {
        schedule.days.forEach(function(day) {
          oldDays.push(day.name);
        });
      });
      oldDays.forEach(function(day) {
        var index = alldays.indexOf(day);

        if (index > -1) {
          alldays.splice(index, 1);
        }
      });

      return alldays;
    }
  },
  methods: {
    findError(name) {
      const result = this.errors.filter(error => error.name === name);
      if (result.length !== 0) {
        return result[0].content;
      }
    },
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
    },
    createSchedule() {
      const color = document.querySelector('input[name="color"]:checked').value;
      this.errors = [];
      const scheduledays = [];
      const name = document.getElementById("scheduleName").value;
      if (name === "") {
        const error = {
          name: "name",
          content: "vous n‘avez pas entré de nom pour votre agenda"
        };
        this.errors.push(error);
      }
      this.days.forEach(day => {
        const theDay = document.querySelector("#" + day);
        if (theDay.checked === true) {
          const ms = document.getElementById("ms-" + day).value;
          const me = document.getElementById("me-" + day).value;
          const as = document.getElementById("as-" + day).value;
          const ae = document.getElementById("ae-" + day).value;

          if (ms > me || ms > as || ms > ae || me > as || me > ae || as > ae) {
            const error = {
              name: day,
              content: "Vos heures ne sont pas juste"
            };
            this.errors.push(error);
          }

          var radios = document.getElementsByName("timer-" + day);
          for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
              var time = radios[i].value;

              break;
            }
          }

          const dayData = {
            name: day,
            ms: ms,
            me: me,
            as: as,
            ae: ae,
            time: time
          };

          scheduledays.push(dayData);
        }
      });
      if (scheduledays.length === 0) {
        const error = {
          name: "emptyDay",
          content: "Vous n‘avez sélectionné aucun jour"
        };
        this.errors.push(error);
      }
      if (this.errors.length === 0) {
        window.axios
          .post("/createSchedule", {
            name: name,
            color: color,
            days: scheduledays
          })
          .then(response => {
            //console.log(response.data);
            router.go(-1);
          })
          .catch(function(error) {
            console.log(error.response.data.message);
          });
      }
    },
    makeMyCHoice(choice) {
      this.choice = choice;
    },
    createScheduleSameHour() {
      const scheduledays = [];
      this.errors = [];
      const color = document.querySelector('input[name="color"]:checked').value;
      const days = document.querySelectorAll(".radioButton__day:checked");
      const ms = document.getElementById("ms").value;
      const me = document.getElementById("me").value;
      const as = document.getElementById("as").value;
      const ae = document.getElementById("ae").value;
      const time = document.querySelector('input[name="timer"]:checked').value;

      const name = document.getElementById("scheduleName").value;
      if (name === "") {
        const error = {
          name: "name",
          content: "vous n‘avez pas entré de nom pour votre agenda"
        };
        this.errors.push(error);
      }

      if (ms > me || ms > as || ms > ae || me > as || me > ae || as > ae) {
        const error = {
          name: "same",
          content: "Vos heures ne sont pas juste"
        };
        this.errors.push(error);
      }
      days.forEach(function(day) {
        const dayData = {
          name: day.value,
          ms: ms,
          me: me,
          as: as,
          ae: ae,
          time: time
        };
        scheduledays.push(dayData);
      });

      if (scheduledays.length === 0) {
        const error = {
          name: "emptyDay",
          content: "Vous n‘avez sélectionné aucun jour"
        };
        this.errors.push(error);
      }

      if (this.errors.length === 0) {
        window.axios
          .post("/createSchedule", {
            name: name,
            color: color,
            days: scheduledays
          })
          .then(response => {
            //console.log(response.data);
            router.go(-1);
          })
          .catch(function(error) {
            console.log(error.response.data.message);
          });
      }
    }
  }
};
</script>
