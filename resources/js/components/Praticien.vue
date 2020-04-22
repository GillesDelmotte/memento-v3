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
import router from "../router.js";

export default {
  name: "Praticien",
  data() {
    return {};
  },
  methods: {
    addComment() {
      var comment = document.querySelector(".addComment__textarea").value;
      window.axios
        .post("/addComment", {
          user_id: this.practitioner.id,
          comment: comment
        })
        .then(response => {
          this.practitioner.comments.push({
            id: response.data.id,
            comment: response.data.comment,
            user_id: response.data.user_id,
            client_id: response.data.client_id,
            owner: this.currentUser
          });
          document.querySelector(".addComment__textarea").value = "";
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
    }
  },
  computed: {
    ...mapState(["allJob", "allPractitioner", "currentUser"]),
    practitioner() {
      const practitioner = this.allPractitioner.filter(
        practitioner => practitioner.id === this.$route.params.id
      );
      return practitioner[0];
    }
  }
};
</script>
