<template>
  <div>
    <div class="bgc__logo schedule"></div>
    <header-component title="Mon horaire"></header-component>
    <div
      class="emptyDay"
      v-if="createListMorning.length === 0 "
    >Vous n'avez pas d'horaire pour aujourd'hui</div>
    <ul class="schedule__list">
      <li v-for="hour in createListMorning" :key="hour">
        <div class="schedule__list__hour">{{formatedHour(hour)}}</div>
        <div class="schedule__list__appointment" v-if="reserved(hour) === false">Pas de rendez-vous</div>
        <div class="schedule__list__appointment myAppointment" v-else>{{reserved(hour)}}</div>
      </li>
    </ul>
    <ul class="schedule__list">
      <li v-for="hour in createListAfternoon" :key="hour">
        <div class="schedule__list__hour">{{formatedHour(hour)}}</div>
        <div class="schedule__list__appointment" v-if="reserved(hour) === false">Pas de rendez-vous</div>
        <div class="schedule__list__appointment myAppointment" v-else>{{reserved(hour)}}</div>
      </li>
    </ul>
    <div :class="'aside close ' + currentUser.theme">
      <div class="aside__close"></div>
      <h2 class="aside__title">Date</h2>
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
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  name: "Schedule",
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
      appointments: [],
      dayNumber: null,
      monthNumber: null,
      number0fdDayInMonth: null,
      year: null,
      date: null
    };
  },
  computed: {
    ...mapState(["currentUser"]),
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
      this.currentUser.schedules.forEach(schedule => {
        var test = schedule.days.find(day => {
          return day.name === this.days[this.dayNumber];
        });
        if (test != undefined) {
          day = test;
        }
      });

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
      this.currentUser.schedules.forEach(schedule => {
        var test = schedule.days.find(day => {
          return day.name === this.days[this.dayNumber];
        });
        if (test != undefined) {
          day = test;
        }
      });

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
      const listOfDays = [];
      this.currentUser.schedules.forEach(schedule => {
        schedule.days.forEach(day => {
          listOfDays.push(day);
        });
      });
      for (let i = 1; i <= this.calculatedNumberOfDay; i++) {
        if (this.date) {
          const splitDate = this.date.split("-");
          const d = new Date(splitDate[1] + "-" + i + "-" + splitDate[2]);

          var test = listOfDays.find(day => {
            return day.name === this.days[d.getDay()];
          });

          if (test != undefined) {
            var color = test.color;
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

      console.log(listOfNumber);

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
    reserved(hour) {
      const splitDate = this.date.split("-");
      const appointment = this.appointments.filter(
        appointment =>
          appointment.hour === hour &&
          appointment.date ===
            splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0]
      );
      if (appointment[0] != undefined) {
        return appointment[0].user.name;
      } else {
        return false;
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
  },
  beforeMount() {
    window.axios
      .post("/getMyScheduleAppointments")
      .then(response => {
        this.appointments = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
