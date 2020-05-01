<template>
  <div class="profil">
    <header-component title="Mon profil"></header-component>
    <user-infos :person="currentUser" :userProfil="true"></user-infos>
    <section class="comments">
      <h2 class="comments__title">Commentaires</h2>
      <ul class="comments__list" v-if="currentUser.comments.length !== 0">
        <comment v-for="comment in currentUser.comments" :key="comment.id" :comment="comment"></comment>
      </ul>
      <div v-else class="comments__empty">Il n'y a pas de commentaires sur votre profil</div>
    </section>
    <div class="aside__bgc close" @click="closePopupWithBackground"></div>
    <div class="aside close" @click="openFilter">
      <div class="aside__close"></div>
      <h2 class="aside__title">Mes agendas</h2>
      <ul class="aside__list">
        <li>Mon premier</li>
        <li>Mon deuxième</li>
        <li>Mon troisième</li>
      </ul>
      <a href class="aside__link">Créer un agenda</a>
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
      const bgc = document.querySelector(".aside__bgc");
      if (filter.classList.contains("close")) {
        filter.classList.remove("close");
        bgc.classList.remove("close");
        document.querySelector("body").classList.add("freeze");
      } else {
        filter.classList.add("close");
        bgc.classList.add("close");
        document.querySelector("body").classList.remove("freeze");
      }
    },
    closePopupWithBackground(e) {
      const bgc = document.querySelector(".aside__bgc");
      const filter = document.querySelector(".aside");
      if (e.target === bgc) {
        bgc.classList.add("close");
        filter.classList.add("close");
        document.querySelector("body").classList.remove("freeze");
      }
    }
  },
  mounted() {
    this.$store.dispatch("setCurrentUser");
  }
};
</script>
