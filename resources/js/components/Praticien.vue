<template>
  <div>
    <user-infos :person="practitioner" :userProfil="false"></user-infos>
    <section class="comments">
      <h2 class="comments__title">Commentaires</h2>
      <ul class="comments__list" v-if="practitioner.comments.length !== 0">
        <comment v-for="comment in practitioner.comments" :key="comment.id" :comment="comment"></comment>
      </ul>
      <div v-else class="comments__empty">il n'y a pas de commentaire</div>
      <section class="addComment">
        <h2 class="addComment__title sr-only">Ajouter un commentaire</h2>
        <label for="addComment" class="addComment__label">Mon commentaire</label>
        <textarea name="comment" id="addComment" class="addComment__textarea" placeholder="..."></textarea>
        <button @click="addComment" class="addComment__button">Poster mon commentaire</button>
      </section>
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
  methods: {
    addComment() {
      console.log(this.practitioner);
    }
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
