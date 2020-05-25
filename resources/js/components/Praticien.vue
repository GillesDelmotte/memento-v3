<template>
  <div>
    <user-infos :person="practitioner" :userProfil="false"></user-infos>
    <section class="comments">
      <h2 class="comments__title">Commentaires</h2>
      <ul class="comments__list" v-if="practitioner.comments.length !== 0">
        <comment v-for="comment in practitioner.comments" :key="comment.id" :comment="comment"></comment>
      </ul>
      <div v-else class="comments__empty">il n'y a pas de commentaire</div>
      <section class="addComment">
        <h2 class="addComment__title sr-only">Ajouter un commentaire</h2>
        <label for="addComment" class="addComment__label">Mon commentaire</label>
        <textarea name="comment" id="addComment" class="addComment__textarea" placeholder="..."></textarea>
        <button @click="addComment" class="addComment__button">Poster mon commentaire</button>
      </section>
    </section>
    <div :class="'aside close ' + currentUser.theme">
      <div class="aside__close" @click="openFilter"></div>
      <h2 class="filter__title">Horaires du praticien</h2>
      <ul class="aside__list" v-if="selectedPractitionnerSchedules.length != 0">
        <li v-for="schedule in selectedPractitionnerSchedules" :key="schedule.id">
          <p>{{schedule.name}}</p>
          <div>
            <span
              v-for="day in schedule.days"
              :key="day.id"
              :title="day.name"
            >{{day.name.charAt(0)}}</span>
          </div>
          <a href class="aside__list__link" @click.prevent.stop="goOnSchedule(schedule.id)"></a>
        </li>
      </ul>
      <div v-else class="aside__error">Votre praticien n'a pas encore créer d'horaire</div>
      <!-- <a href class="aside__link">Chercher un date</a> -->
    </div>
    <div class="aside__button schedule" @click="openFilter"></div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import router from "../router.js";
import store from "../store.js";
export default {
  name: "Praticien",
  data() {
    return {
      schedules: null
    };
  },
  methods: {
    addComment() {
      var comment = document.querySelector(".addComment__textarea").value;
      window.axios
        .post("/addComment", {
          user_id: this.practitioner.id,
          comment: comment
        })
        .then(response => {
          this.practitioner.comments.push({
            id: response.data.id,
            comment: response.data.comment,
            user_id: response.data.user_id,
            client_id: response.data.client_id,
            owner: this.currentUser
          });
          document.querySelector(".addComment__textarea").value = "";
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
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
    goOnSchedule(scheduleId) {
      router.push({
        name: "praticien-schedule",
        params: { id: this.$route.params.id, scheduleId: scheduleId }
      });
      window.scrollTo(0, 0);
    }
  },
  computed: {
    ...mapState([
      "allJob",
      "allPractitioner",
      "currentUser",
      "selectedPractitionnerSchedules"
    ]),
    practitioner() {
      const practitioner = this.allPractitioner.filter(
        practitioner => practitioner.id === this.$route.params.id
      );
      return practitioner[0];
    }
  },
  beforeMount() {
    this.$store.dispatch(
      "setScheduleForSelectedPratitionner",
      this.$route.params.id
    );
  }
};
</script>
