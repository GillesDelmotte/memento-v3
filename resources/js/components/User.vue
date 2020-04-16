<template>
  <div>
    <header-component title="Mon profil"></header-component>
    <user-infos :person="currentUser"></user-infos>
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
  mounted() {
    this.$store.dispatch("setCurrentUser");
  }
};
</script>
