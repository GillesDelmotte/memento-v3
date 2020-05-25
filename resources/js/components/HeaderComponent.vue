<template>
  <div :class="'header ' + currentUser.theme">
    <div class="header__logo">M</div>
    <div class="header__title">{{title}}</div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "HeaderComponent",
  props: ["title"],
  computed: {
    ...mapState(["currentUser"])
  }
};
</script>
