<template>
  <div>
    <navigation></navigation>
    <router-view></router-view>
  </div>
</template>

<script>
Vue.component("navigation", require("./Navigation.vue").default);
//Vue.component("header-component", require("./Header.vue").default);
import router from "../router.js";

export default {
  name: "Home",
  props: {
    route: String
  }
};
</script>
