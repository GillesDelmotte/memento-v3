<template>
  <div>
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
  mounted() {
    this.$store.dispatch("setCurrentUser");
  }
};
</script>
