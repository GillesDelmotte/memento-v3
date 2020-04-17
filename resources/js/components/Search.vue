<template>
  <div>
    <ul class="userCards">
      <user-card v-for="user in allPractitioner" :key="user.id" :user="user"></user-card>
    </ul>
  </div>
</template>
<script>
import store from "../store.js";
import { mapMutations } from "vuex";
import router from "../router.js";
import { mapState } from "vuex";

export default {
  name: "Search",
  data() {
    return {};
  },
  computed: {
    ...mapState(["allJob", "allPractitioner"])
  },
  mounted() {
    this.$store.dispatch("setAllJob").then(() => {
      this.$store.dispatch("setAllPractitioner");
    });
  }
};
</script>
