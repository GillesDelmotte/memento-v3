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
    <div class="aside close">
      <div class="aside__close" @click="openFilter"></div>
      <h2 class="filter__title sr-only">Horaire du praticien</h2>
      <a href class="aside__link">Prendre rendez-vous</a>
      <div
        class="aside__explanation"
      >Pour ne pas chercher dans l’horaire, vous pouvez selectionner une date et heure ci-dessous, nous vous dirons directement si la plage horaire est libre.</div>
      <input type="date" name="filter" class="filter__input" id="filter" autocomplete="off" />
      <input type="time" name="filter" class="filter__input" id="filter" autocomplete="off" />
      <a href class="aside__link sendDate">Envoyer ma date</a>
    </div>
    <div class="aside__button schedule" @click="openFilter"></div>
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
    },
    openFilter() {
      const filter = document.querySelector(".aside");
      const nav = document.querySelector(".nav");
      nav.classList.remove("responsive__open");
      if (filter.classList.contains("close")) {
        filter.classList.remove("close");
      } else {
        filter.classList.add("close");
      }
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
