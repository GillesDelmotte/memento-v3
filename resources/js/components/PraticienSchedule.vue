<template>
  <div>
    <div v-if="componentReady">
      <div class="modifyAppointment" v-if="changeHour">
        Modification du rendez-vous ( {{selectedFormatDate}} )
        <span
          class="modifyAppointment__cross"
          @click="stopUpdate"
        ></span>
      </div>
      <div
        class="emptyDay"
        v-if="createListMorning.length === 0 "
      >Votre praticien n'a pas d'agenda pour aujourd'hui</div>
      <ul class="schedule__list">
        <li v-for="hour in createListMorning" :key="hour">
          <div class="schedule__list__hour">{{formatedHour(hour)}}</div>
          <div
            class="schedule__list__appointment myAppointment"
            v-if="reserved(hour) === 'myAppointment'"
          >
            <a href class="myAppointment__Link" @click.prevent.stop="updateHour(hour)"></a>
            <div class="cross" @click="deleteAppointment(hour)">
              <div class="first"></div>
              <div class="second"></div>
            </div>
            {{currentUser.name}}
          </div>
          <div class="schedule__list__appointment false" v-else-if="reserved(hour) === false">&nbsp;</div>
          <div
            class="schedule__list__appointment true"
            @click.prevent.stop="reserve(hour)"
            v-if="reserved(hour) === true"
          >Plage horaire disponible</div>
        </li>
      </ul>
      <ul class="schedule__list">
        <li v-for="hour in createListAfternoon" :key="hour">
          <div class="schedule__list__hour">{{formatedHour(hour)}}</div>
          <div
            class="schedule__list__appointment myAppointment"
            v-if="reserved(hour) === 'myAppointment'"
          >
            <a href class="myAppointment__Link" @click.prevent.stop="updateHour(hour)"></a>
            <div class="cross" @click="deleteAppointment(hour)">
              <div class="first"></div>
              <div class="second"></div>
            </div>
            {{currentUser.name}}
          </div>
          <div class="schedule__list__appointment false" v-else-if="reserved(hour) === false">&nbsp;</div>
          <div
            class="schedule__list__appointment true"
            @click.prevent.stop="reserve(hour)"
            v-if="reserved(hour) === true"
          >Plage horaire disponible</div>
        </li>
      </ul>
      <div :class="'aside close ' + currentUser.theme">
        <div class="aside__close"></div>
        <h2 class="aside__title sr-only">Date</h2>
        <div class="aside__user__infos">
          <div class="aside__user__infos__name">{{practitioner.name}}</div>
          <div class="aside__user__infos__schedule">{{schedule.name}}</div>
        </div>
        <div class="aside__date">
          <span class="aside__date__previous" @click="previousMonth"></span>
          <div>{{months[monthNumber]}}, {{year}}</div>
          <span class="aside__date__next" @click="nextMonth"></span>
        </div>
        <div class="aside__days">
          <ul class="aside__days__ul">
            <li
              :class="calculatedClass(dayNumber)"
              v-for="dayNumber in makeListOfNumberOfDay"
              :key="dayNumber.number"
              @click="changeDay(dayNumber.number)"
            >{{dayNumber.number}}</li>
          </ul>
        </div>
      </div>
      <div class="aside__button schedule" @click="openFilter"></div>

      <div class="error" v-if="error != ''" @click="deleteError">
        <span class="error__cross" @click="deleteError"></span>
        {{error}}
      </div>

      <div class="popup" @click="closePopupWithBackground($event)">
        <div class="popup__window">
          <span class="popup__window__close--cross" @click="closePopup"></span>
          <h2 class="popup__window__title">Voulez vous changer</h2>
          <div class="popup__window__hour">Le {{selectedFormatDate}}</div>
          <div class="popup__window__hour__sign" v-if="this.changeHour"></div>
          <div class="popup__window__hour" v-if="this.changeHour">Le {{selectedFormatNewDate}}</div>
          <div class="popup__widow__buttons" v-if="!this.changeHour">
            <button class="popup__window__save" @click="startUpdate">Modifier le rendez-vous</button>
            <button class="popup__window__save" @click="deleteFromPopUp">Supprimer le rendez-vous</button>
          </div>
          <div class="popup__widow__buttons" v-if="this.changeHour">
            <button class="popup__window__save" @click="endUpdate">Oui je le veux</button>
            <button class="popup__window__save" @click="closePopup">Non je ne veux pas</button>
            <button class="popup__window__save" @click="stopUpdate">Annuler</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import router from "../router.js";
import store from "../store.js";

export default {
  name: "PraticienSchedule",
  data() {
    return {
      days: [
        "dimanche",
        "lundi",
        "mardi",
        "mercredi",
        "jeudi",
        "vendredi",
        "samedi"
      ],
      months: [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Aout",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre"
      ],
      changeHour: false,
      selectedHour: "",
      selectedNewHour: "",
      selectedDate: null,
      selectedNewDate: null,
      selectedFormatDate: null,
      selectedFormatNewDate: null,
      dayNumber: null,
      monthNumber: null,
      number0fdDayInMonth: null,
      year: null,
      date: null,
      error: "",
      practitioner: null,
      componentReady: false
    };
  },
  computed: {
    ...mapState([
      "selectedPractitionnerSchedules",
      "allPractitioner",
      "currentUser"
    ]),
    schedule() {
      const schedule = this.selectedPractitionnerSchedules.find(schedule => {
        return schedule.id === this.$route.params.scheduleId;
      });
      return schedule;
    },
    day() {
      var d = new Date();

      var today = new Date();
      var dd = String(today.getDate()).padStart(2, "0");
      var mm = String(today.getMonth() + 1).padStart(2, "0");
      var yyyy = today.getFullYear();
      today = dd + "-" + mm + "-" + yyyy;

      this.date = today;

      this.dayNumber = d.getDay();
      this.monthNumber = d.getMonth();
      this.year = yyyy;
    },
    createListMorning() {
      const morning = [];
      var day = "";

      var test = this.schedule.days.find(day => {
        return day.name === this.days[this.dayNumber];
      });
      if (test != undefined) {
        day = test;
      }

      if (day != "") {
        var ms = day.ms.split(":");
        var msh = parseInt(ms[0], 10);
        var msm = parseInt(ms[1], 10);

        morning.push(msh + ":" + msm);

        const milliDateStart = new Date("1970-01-01T" + day.ms + "Z").getTime();
        const milliDateEnd = new Date("1970-01-01T" + day.me + "Z").getTime();

        const diff = (milliDateEnd - milliDateStart) / (day.time * 60000);

        for (var i = 1; i <= diff; i++) {
          //var test = msm;
          msm = msm + day.time;

          if (msm >= 60) {
            msm = msm - 60;
            msh += 1;
            morning.push(msh + ":" + msm);
          } else {
            morning.push(msh + ":" + msm);
          }
        }
      }

      return morning;
    },
    createListAfternoon() {
      const afternoon = [];
      var day = "";

      var test = this.schedule.days.find(day => {
        return day.name === this.days[this.dayNumber];
      });
      if (test != undefined) {
        day = test;
      }

      if (day != "") {
        var as = day.as.split(":");
        var ash = parseInt(as[0], 10);
        var asm = parseInt(as[1], 10);

        afternoon.push(ash + ":" + asm);

        const milliDateStart = new Date("1970-01-01T" + day.as + "Z").getTime();
        const milliDateEnd = new Date("1970-01-01T" + day.ae + "Z").getTime();

        const diff = (milliDateEnd - milliDateStart) / (day.time * 60000);

        for (var i = 1; i <= diff; i++) {
          //var test = asm;
          asm = asm + day.time;

          if (asm >= 60) {
            asm = asm - 60;
            ash += 1;
            afternoon.push(ash + ":" + asm);
          } else {
            afternoon.push(ash + ":" + asm);
          }
        }
      }

      return afternoon;
    },
    calculatedNumberOfDay() {
      return new Date(this.year, this.monthNumber + 1, 0).getDate();
    },
    makeListOfNumberOfDay() {
      const listOfNumber = [];
      for (let i = 1; i <= this.calculatedNumberOfDay; i++) {
        if (this.date) {
          const splitDate = this.date.split("-");
          const d = new Date(splitDate[1] + "-" + i + "-" + splitDate[2]);

          var test = this.schedule.days.find(day => {
            return day.name === this.days[d.getDay()];
          });

          if (test != undefined) {
            var color = "grey";
          } else {
            var color = undefined;
          }

          if (i == splitDate[0]) {
            var active = true;
          } else {
            var active = false;
          }
          const number = { active: active, number: i, color: color };
          listOfNumber.push(number);
        }
      }

      return listOfNumber;
    }
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
    nextMonth() {
      this.error = "";
      this.monthNumber = this.monthNumber + 1;
      if (this.monthNumber === 12) {
        this.monthNumber = 0;
        this.year = this.year + 1;
      }

      const splitDate = this.date.split("-");
      const date = this.monthNumber + 1 + "-" + splitDate[0] + "-" + this.year;

      const newDate = new Date(date);

      this.dayNumber = newDate.getDay();
      this.monthNumber = newDate.getMonth();

      var dd = String(newDate.getDate()).padStart(2, "0");
      var mm = String(newDate.getMonth() + 1).padStart(2, "0"); //January is 0!
      var yyyy = newDate.getFullYear();

      this.date = dd + "-" + mm + "-" + yyyy;
    },
    previousMonth() {
      this.error = "";
      this.monthNumber = this.monthNumber - 1;
      if (this.monthNumber === -1) {
        this.monthNumber = 11;
        this.year = this.year - 1;
      }

      const splitDate = this.date.split("-");
      const date = this.monthNumber + 1 + "-" + splitDate[0] + "-" + this.year;

      const newDate = new Date(date);

      this.dayNumber = newDate.getDay();
      this.monthNumber = newDate.getMonth();

      var dd = String(newDate.getDate()).padStart(2, "0");
      var mm = String(newDate.getMonth() + 1).padStart(2, "0"); //January is 0!
      var yyyy = newDate.getFullYear();

      this.date = dd + "-" + mm + "-" + yyyy;
    },
    changeDay(day) {
      this.error = "";
      const splitDate = this.date.split("-");
      const date = this.monthNumber + 1 + "-" + day + "-" + this.year;

      const newDate = new Date(date);

      this.dayNumber = newDate.getDay();
      this.monthNumber = newDate.getMonth();

      var dd = String(newDate.getDate()).padStart(2, "0");
      var mm = String(newDate.getMonth() + 1).padStart(2, "0"); //January is 0!
      var yyyy = newDate.getFullYear();

      this.date = dd + "-" + mm + "-" + yyyy;
    },
    reserve(hour) {
      if (this.changeHour) {
        this.checkUpdate(hour);
        return false;
      }
      const splitDate = this.date.split("-");

      const data = {
        user_id: this.currentUser.id,
        schedule_id: this.schedule.id,
        hour: hour,
        date: splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0]
      };

      window.axios
        .post("/createAppointment", data)
        .then(response => {
          if (response.data === false) {
            this.error = "Vous avez déja un rendez-vous pour ce jour-ci";
            return;
          }
          this.$store.dispatch(
            "setScheduleForSelectedPratitionner",
            this.$route.params.id
          );
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
    },
    checkUpdate(hour) {
      document.querySelector(".popup").classList.add("open");
      document.querySelector("body").classList.add("freeze");

      this.selectedNewDate = this.date;
      this.selectedNewHour = hour;

      const splitDate = this.selectedNewDate.split("-");

      const test = new Date(
        splitDate[1] + "-" + splitDate[0] + "-" + splitDate[2]
      );

      const day = this.days[test.getDay()];
      const month = this.months[test.getMonth()];

      const formatedDate =
        day +
        " " +
        splitDate[0] +
        " " +
        month +
        " " +
        splitDate[2] +
        " à " +
        hour;

      this.selectedFormatNewDate = formatedDate;
    },
    reserved(hour) {
      const splitDate = this.date.split("-");
      const appointment = this.schedule.appointments.filter(
        appointment =>
          appointment.hour === hour &&
          appointment.date ===
            splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0]
      );
      if (appointment[0] != undefined) {
        if (appointment[0].user_id === this.currentUser.id) {
          return "myAppointment";
        }
        return false;
      } else {
        return true;
      }
    },
    deleteError() {
      this.error = "";
    },
    deleteAppointment(hour) {
      const splitDate = this.date.split("-");

      window.axios
        .post("/deleteAppointment", {
          schedule_id: this.schedule.id,
          hour: hour,
          date: splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0]
        })
        .then(response => {
          this.$store.dispatch(
            "setScheduleForSelectedPratitionner",
            this.$route.params.id
          );
        })
        .catch(error => console.error(error));
    },
    deleteFromPopUp() {
      const splitDate = this.selectedDate.split("-");

      window.axios
        .post("/deleteAppointment", {
          schedule_id: this.schedule.id,
          hour: this.selectedHour,
          date: splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0]
        })
        .then(response => {
          this.$store.dispatch(
            "setScheduleForSelectedPratitionner",
            this.$route.params.id
          );
        })
        .catch(error => console.error(error));
      document.querySelector(".popup").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
    },
    updateHour(hour) {
      if (this.changeHour) {
        this.error = "vous avez déjà un rendez-vous à cette heure la";
        return false;
      }
      document.querySelector(".popup").classList.add("open");
      document.querySelector("body").classList.add("freeze");

      this.selectedDate = this.date;
      this.selectedHour = hour;

      const splitDate = this.selectedDate.split("-");

      const test = new Date(
        splitDate[1] + "-" + splitDate[0] + "-" + splitDate[2]
      );

      const day = this.days[test.getDay()];
      const month = this.months[test.getMonth()];

      const formatedDate =
        day +
        " " +
        splitDate[0] +
        " " +
        month +
        " " +
        splitDate[2] +
        " à " +
        hour;

      this.selectedFormatDate = formatedDate;
    },
    startUpdate() {
      document.querySelector(".popup").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
      this.changeHour = true;
    },
    endUpdate() {
      const splitSelectedDate = this.selectedDate.split("-");
      const splitSelectedNewDate = this.selectedNewDate.split("-");

      const data = {
        lastDate:
          splitSelectedDate[2] +
          "-" +
          splitSelectedDate[1] +
          "-" +
          splitSelectedDate[0],
        lastHour: this.selectedHour,
        newDate:
          splitSelectedNewDate[2] +
          "-" +
          splitSelectedNewDate[1] +
          "-" +
          splitSelectedNewDate[0],
        newHour: this.selectedNewHour,
        user_id: this.currentUser.id,
        schedule_id: this.schedule.id
      };

      window.axios
        .post("/updateAppointment", data)
        .then(response => {
          if (response.data === false) {
            this.error = "Vous avez déja un rendez-vous pour ce jour-ci";
            document.querySelector(".popup").classList.remove("open");
            document.querySelector("body").classList.remove("freeze");
            return;
          }
          this.$store.dispatch(
            "setScheduleForSelectedPratitionner",
            this.$route.params.id
          );
          this.stopUpdate();
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
    },
    stopUpdate() {
      document.querySelector(".popup").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
      this.changeHour = false;
    },
    closePopup() {
      document.querySelector(".popup").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
      if (!this.changeHour) {
        this.selectedHour = null;
        this.selectedDate = null;
        this.selectedFormatDate = null;
      }
    },
    closePopupWithBackground(e) {
      const bgc = document.querySelector(".popup");
      if (e.target === bgc) {
        bgc.classList.remove("open");
        document.querySelector("body").classList.remove("freeze");
        if (!this.changeHour) {
          this.selectedHour = null;
          this.selectedDate = null;
          this.selectedFormatDate = null;
        }
      }
    },
    formatedHour(hour) {
      const splitHour = hour.split(":");
      if (splitHour[1] === "0") {
        return splitHour[0] + "H00";
      } else {
        return splitHour[0] + "H" + splitHour[1];
      }
    },
    calculatedClass(data) {
      if (data.active) {
        return "aside__days__ul__li active";
      } else if (data.color) {
        return "aside__days__ul__li " + data.color;
      } else {
        return "aside__days__ul__li";
      }
    }
  },
  mounted() {
    this.day;

    Echo.channel("appointement-created").listen(".appointment.created", e => {
      this.schedule.appointments.push(e.appointment);
    });

    Echo.channel("appointement-deleted").listen(".appointment.deleted", e => {
      var index = this.schedule.appointments.findIndex(
        appointment => appointment.id === e.appointment.id
      );

      this.schedule.appointments.splice(index, 1);
    });
  },
  beforeMount() {
    this.$store.dispatch(
      "setScheduleForSelectedPratitionner",
      this.$route.params.id
    );

    window.axios
      .post("/getSelectedPractitioner", { id: this.$route.params.id })
      .then(response => {
        this.practitioner = response.data;
        this.componentReady = true;
      });
  }
};
</script>
