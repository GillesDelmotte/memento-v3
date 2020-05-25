<template>
  <div class="appointment">
    <div v-if="appointment.schedule.practitioner.profilPic" class="appointment__img--true">
      <img :src="'../images/profiles/' + appointment.schedule.practitioner.profilPic" alt />
    </div>
    <div class="appointment__img" v-else></div>
    <div class="appointment__infos">
      <h2 class="appointment__infos__name">
        <a
          href
          @click.prevent.stop="goOn(appointment.schedule.practitioner.id)"
        >{{appointment.schedule.practitioner.name}}</a>
      </h2>
      <p class="appointment__infos__job">{{appointment.schedule.practitioner.job.name}}</p>
      <p class="appointment__infos__date">{{formatDate}}</p>
    </div>
    <div class="appointment__icons">
      <!-- <a
        href
        @click.prevent.stop="goOnSchedule(appointment.schedule.id)"
        :title="'aller sur l‘horaire de ' + appointment.schedule.practitioner.name"
        class="appointment__icons__link appointment__icons__link--schedule"
      >
        <span class="sr-only">aller sur l'horaire de {{appointment.schedule.practitioner.name}}</span>
      </a>-->
      <a
        :href="'mailto:' + appointment.schedule.practitioner.email"
        :title="'envoyer un email à ' + appointment.schedule.practitioner.name"
        class="appointment__icons__link appointment__icons__link--mail"
      >
        <span class="sr-only">envoyer un email à {{appointment.schedule.practitioner.name}}</span>
      </a>
      <a
        :href="'tel:' + appointment.schedule.practitioner.gsm"
        :title="'téléphoner a ' + appointment.schedule.practitioner.name"
        class="appointment__icons__link appointment__icons__link--phone"
      >
        <span class="sr-only">téléphoné à {{appointment.schedule.practitioner.name}}</span>
      </a>
    </div>
  </div>
</template>
<script>
import router from "../router.js";

export default {
  name: "Appointment",
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
      ]
    };
  },
  props: {
    appointment: Object
  },
  computed: {
    formatDate() {
      const date = this.appointment.date;
      const splitDate = date.split("-");
      const test = new Date(
        splitDate[1] + "-" + splitDate[2] + "-" + splitDate[0]
      );
      const day = this.days[test.getDay()];
      const month = this.months[test.getMonth()];

      const formatedDate =
        day + " " + splitDate[2] + " " + month + " " + splitDate[0];

      return formatedDate;
    }
  },
  methods: {
    goOn(id) {
      router.push({
        name: "praticien",
        params: {
          id: id
        }
      });
      window.scrollTo(0, 0);
    }
  }
};
</script>
