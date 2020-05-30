<template>
  <div :class="'header ' + currentUser.theme">
    <div class="header__logo">M</div>
    <div class="header__right">
      <div class="header__right__profile" @click="goOnProfile">
        <div class="name">{{currentUser.name}}</div>
        <div class="profilePic--true" v-if="currentUser.profilPic">
          <img :src="'../images/profiles/' + currentUser.profilPic" alt />
        </div>
        <div class="profilePic--false" v-else></div>
      </div>
      <div class="header__right__title">{{title}}</div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import router from "../router.js";

export default {
  name: "HeaderComponent",
  props: ["title"],
  computed: {
    ...mapState(["currentUser"])
  },
  methods: {
    goOnProfile() {
      router.push({ name: "user" });
      window.scrollTo(0, 0);
    }
  }
};
</script>
