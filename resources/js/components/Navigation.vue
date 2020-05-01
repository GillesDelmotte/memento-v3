<template>
  <div class="nav">
    <div class="nav__logo">M</div>
    <div class="nav__links">
      <router-link :to="{name:'meet'}" active-class="active" class="nav__link meet">
        <i class="icon"></i>
        <span>Rendez-vous</span>
      </router-link>
      <router-link :to="{name:'search'}" active-class="active" class="nav__link praticiens">
        <i class="icon"></i>
        <span>Praticiens</span>
      </router-link>
      <router-link :to="{name:'schedule'}" active-class="active" class="nav__link schedule">
        <i class="icon"></i>
        <span>Horaire</span>
      </router-link>
      <router-link :to="{name:'user'}" active-class="active" class="nav__link user">
        <i class="icon"></i>
        <span>Profil</span>
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
</template>
<script>
export default {
  name: "Navigation",
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
    }
  }
};
</script>
