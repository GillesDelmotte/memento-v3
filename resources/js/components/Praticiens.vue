<template>
  <div>
    <header-component title="Les praticiens"></header-component>
    <router-view></router-view>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "Praticiens",
  data() {
    return {};
  }
};
</script>
