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
    <div class="aside close">
      <div class="aside__close"></div>
      <h2 class="aside__title">Mes agendas</h2>
      <p
        class="aside__error"
        v-if="currentUser.schedules.length === 0"
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
        </li>
      </ul>
      <a @click="redirect('/creation-horaire')" class="aside__link">Créer un agenda</a>
    </div>
    <div class="aside__button schedule" @click="openFilter"></div>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "User",
  data() {
    return {};
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
    }
  },
  mounted() {
    this.$store.dispatch("setCurrentUser");
  }
};
</script>
