<template>
  <div>
    <div class="bgc__logo meet"></div>
    <header-component title="Mes rendez-vous"></header-component>
    <div v-if="componentReady">
      <div class="appointments" v-if="myAppointments.length != 0">
        <appointment
          v-for="appointment in myAppointments"
          :key="appointment.id"
          :appointment="appointment"
        ></appointment>
      </div>
      <div class="emptyAppointment" v-else>
        <p class="emptyAppointment__content">Vous n'avez pas de rendez-vous de prévu</p>
        <div class="emptyAppointment__buttons">
          <a href @click.prevent.stop="goOn('search')">Chercher un praticien</a>
          <a href @click.prevent.stop="goOn('user')">Mon profil</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import store from "../store.js";
import router from "../router.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "Meet",
  data() {
    return {
      myAppointments: [],
      componentReady: false
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
    goOn(page) {
      router.push({ name: page });
      window.scrollTo(0, 0);
    }
  },
  mounted() {},
  beforeMount() {
    this.$store.dispatch("setCurrentUser").then(() => {
      if (this.currentUser.is_admin === 1) {
        this.$router.push("/statistiques");
      } else {
        window.axios
          .post("/getMyAppointments")
          .then(response => {
            console.log("cest la reponse");
            this.myAppointments = response.data;
            this.componentReady = true;
          })
          .catch(error => {
            console.log(error);
          });
      }
    });
  }
};
</script>
