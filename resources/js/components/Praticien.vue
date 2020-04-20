<template>
  <div>
    <user-infos :person="practitioner" :userProfil="false"></user-infos>
    <section class="comments">
      <h2 class="comments__title">Commentaires</h2>
      <ul class="comments__list">
        <comment v-for="comment in practitioner.comments" :key="comment.id" :comment="comment"></comment>
      </ul>
    </section>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  name: "Praticien",
  data() {
    return {};
  },
  computed: {
    ...mapState(["allJob", "allPractitioner"]),
    practitioner() {
      const practitioner = this.allPractitioner.filter(
        practitioner => practitioner.id === this.$route.params.id
      );
      return practitioner[0];
    }
  }
};
</script>
