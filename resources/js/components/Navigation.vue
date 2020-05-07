<template>
  <div>
    <div class="nav" v-if="currentUser.is_admin === 1">
      <div class="nav__links">
        <router-link :to="{name:'stat'}" active-class="active" class="nav__link stat">
          <i class="icon" @click="closeResponsiveMenu"></i>
          <span @click="closeResponsiveMenu">Statistiques</span>
        </router-link>
        <router-link :to="{name:'report'}" active-class="active" class="nav__link report">
          <i class="icon" @click="closeResponsiveMenu"></i>
          <span @click="closeResponsiveMenu">Signalement</span>
        </router-link>
        <a @click="logout" ref="logout" shref class="nav__link disconnect">
          <i class="icon"></i>
          <span>Déconnexion</span>
        </a>
      </div>

      <div class="nav__burger" @click="openMenu">
        <span class="top"></span>
        <span class="mid"></span>
        <span class="bottom"></span>
      </div>
    </div>
    <div class="nav" v-else-if="currentUser.is_admin === 0">
      <div class="nav__links">
        <router-link :to="{name:'meet'}" active-class="active" class="nav__link meet">
          <i class="icon" @click="closeResponsiveMenu"></i>
          <span @click="closeResponsiveMenu">Rendez-vous</span>
        </router-link>
        <router-link :to="{name:'search'}" active-class="active" class="nav__link praticiens">
          <i class="icon" @click="closeResponsiveMenu"></i>
          <span @click="closeResponsiveMenu">Praticiens</span>
        </router-link>
        <router-link :to="{name:'schedule'}" active-class="active" class="nav__link schedule">
          <i class="icon" @click="closeResponsiveMenu"></i>
          <span @click="closeResponsiveMenu">Horaire</span>
        </router-link>
        <router-link :to="{name:'user'}" active-class="active" class="nav__link user">
          <i class="icon" @click="closeResponsiveMenu"></i>
          <span @click="closeResponsiveMenu">Profil</span>
        </router-link>
        <a @click="logout" ref="logout" shref class="nav__link disconnect">
          <i class="icon"></i>
          <span>Déconnexion</span>
        </a>
      </div>
      <div class="nav__burger" @click="openMenu">
        <span class="top"></span>
        <span class="mid"></span>
        <span class="bottom"></span>
      </div>
    </div>

    <div class="responsive__burger" @click="responsiveOpenMenu">
      <span class="top"></span>
      <span class="mid"></span>
      <span class="bottom"></span>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  name: "Navigation",
  computed: {
    ...mapState(["currentUser"])
  },
  methods: {
    logout(e) {
      e.preventDefault();
      e.stopPropagation();
      document.getElementById("logout-form").submit();
    },
    openMenu() {
      const nav = document.querySelector(".nav");
      if (nav.classList.contains("open")) {
        nav.classList.remove("open");
      } else {
        nav.classList.add("open");
      }
    },
    closeMenu() {
      const nav = document.querySelector(".nav");
      nav.classList.remove("open");
    },
    responsiveOpenMenu() {
      const nav = document.querySelector(".nav");
      const filter = document.querySelector(".aside");
      if (filter) {
        filter.classList.add("close");
      }
      if (nav.classList.contains("responsive__open")) {
        nav.classList.remove("responsive__open");
      } else {
        nav.classList.add("responsive__open");
      }
    },
    closeResponsiveMenu() {
      const nav = document.querySelector(".nav");
      nav.classList.remove("responsive__open");
    }
  },
  beforeMount() {
    this.$store.dispatch("setCurrentUser");
  }
};
</script>
