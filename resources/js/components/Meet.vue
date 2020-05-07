<template>
  <div>
    <div class="bgc__logo meet"></div>
    <header-component title="Mes rendez-vous"></header-component>
    <div></div>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "Meet",
  data() {
    return {};
  },
  computed: {
    ...mapState(["currentUser"])
  },
  mounted() {},
  beforeMount() {
    this.$store.dispatch("setCurrentUser").then(() => {
      if (this.currentUser.is_admin === 1) {
        this.$router.push("/statistiques");
      }
    });
  }
};
</script>
