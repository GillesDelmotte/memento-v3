<template>
  <div class="profil">
    <header-component title="Mon profil"></header-component>
    <user-infos :person="currentUser" :userProfil="true"></user-infos>
    <section class="comments">
      <h2 class="comments__title">Commentaires</h2>
      <ul class="comments__list" v-if="currentUser.comments.length !== 0">
        <comment v-for="comment in currentUser.comments" :key="comment.id" :comment="comment"></comment>
      </ul>
      <div v-else class="comments__empty">Il n'y a pas de commentaires sur votre profil</div>
    </section>
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
