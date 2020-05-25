<template>
  <div>
    <div class="bgc__logo meet"></div>
    <header-component title="Mes rendez-vous"></header-component>
    <div class="appointments">
      <appointment
        v-for="appointment in myAppointments"
        :key="appointment.id"
        :appointment="appointment"
      ></appointment>
    </div>
    <div :class="'aside close ' + currentUser.theme">
      <div class="aside__close" @click="openFilter"></div>
      <h2 class="filter__title">Filtre</h2>
    </div>
    <div class="aside__button schedule" @click="openFilter"></div>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "Meet",
  data() {
    return {
      myAppointments: null
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
    }
  },
  mounted() {},
  beforeMount() {
    this.$store.dispatch("setCurrentUser").then(() => {
      if (this.currentUser.is_admin === 1) {
        this.$router.push("/statistiques");
      } else {
        window.axios.post("/getMyAppointments").then(response => {
          this.myAppointments = response.data;
        });
      }
    });
  }
};
</script>
