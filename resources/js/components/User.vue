<template>
  <div class="profil">
    <div class="bgc__logo praticien"></div>
    <header-component title="Mon profil"></header-component>
    <user-infos :person="currentUser" :userProfil="true"></user-infos>
    <section class="comments">
      <h2 class="comments__title">Commentaires</h2>
      <ul class="comments__list" v-if="currentUser.comments.length !== 0">
        <comment v-for="comment in currentUser.comments" :key="comment.id" :comment="comment"></comment>
      </ul>
      <div v-else class="comments__empty">Il n'y a pas de commentaires sur votre profil</div>
    </section>
    <div :class="'aside close ' + currentUser.theme" v-if="currentUser.create">
      <div class="aside__close"></div>
      <h2 class="aside__title">Mes agendas</h2>
      <p
        class="aside__error"
        v-if="!currentUser.job_id || !currentUser.address"
      >Veuillez remplir votre profil avant de créer un agenda</p>
      <p
        class="aside__error"
        v-else-if="currentUser.schedules.length === 0"
      >Vous n'avez pas encore enregistré d'agenda</p>
      <ul class="aside__list" v-else>
        <li v-for="schedule in currentUser.schedules" :key="schedule.id">
          <p>{{schedule.name}}</p>
          <div>
            <span
              v-for="day in schedule.days"
              :key="day.id"
              :title="day.name"
            >{{day.name.charAt(0)}}</span>
          </div>
          <div :class="'color ' + schedule.color"></div>
          <div class="delete" @click="startDeleteSchedule(schedule)"></div>
        </li>
      </ul>
      <a
        v-if="currentUser.job_id && currentUser.address"
        @click="redirect('/creation-horaire')"
        class="aside__link"
      >Créer un agenda</a>
    </div>
    <div class="aside__button schedule" @click="openFilter" v-if="currentUser.create"></div>
    <div class="popup deleteSchedule" @click="closePopupWithBackground($event)">
      <div class="popup__window">
        <button class="popup__window__close sr-only" @click="closePopup">close</button>
        <span class="popup__window__close--cross" @click="closePopup"></span>
        <h2 class="popup__window__title">Voulez-vous supprimer ?</h2>
        <div v-if="schedule">
          <div class="popup__window__hour">{{schedule.name}}</div>
          <p
            class="popup__window__add__explanation"
          >Attention, si vous supprimer votre agenda, tous les rendez-vous associé à celui-ci seront également supprimé</p>
        </div>
        <button class="popup__window__save" @click="deleteSchedule">Supprimer</button>
      </div>
    </div>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "User",
  data() {
    return {
      schedule: null
    };
  },
  computed: {
    ...mapState(["currentUser"])
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
    redirect(link) {
      this.$router.push(link);
    },
    startDeleteSchedule(schedule) {
      this.schedule = schedule;
      document.querySelector(".popup.deleteSchedule").classList.add("open");
      document.querySelector("body").classList.add("freeze");
    },
    deleteSchedule() {
      window.axios
        .post("/deleteSchedule", { id: this.schedule.id })
        .then(response => {
          this.$store.dispatch("setCurrentUser");
        });
      document.querySelector(".popup.deleteSchedule").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
      this.schedule = null;
    },
    closePopup() {
      document.querySelector(".popup.deleteSchedule").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
      this.schedule = null;
    },
    closePopupWithBackground(e) {
      const bgc = document.querySelector(".popup.deleteSchedule");
      if (e.target === bgc) {
        bgc.classList.remove("open");
        document.querySelector("body").classList.remove("freeze");
        this.schedule = null;
      }
    }
  },
  mounted() {
    this.$store.dispatch("setCurrentUser");
  }
};
</script>
