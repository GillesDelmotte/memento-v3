<template>
  <div class="nav">
    <router-link :to="{name:'schedule'}" active-class="active">Mon horaire</router-link>
    <router-link :to="{name:'meet'}" active-class="active">Mes rendez-vous</router-link>
    <a @click="logout" ref="logout" href>Déconnexion</a>
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
    }
  }
};
</script>
