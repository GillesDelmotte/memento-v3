<template>
  <div>
    <ul class="userCards" v-if="filteredBy === 'name'">
      <user-card v-for="user in filteredByName" :key="user.id" :user="user"></user-card>
    </ul>
    <ul class="userCards" v-if="filteredBy === 'job'">
      <user-card v-for="user in filteredByJob" :key="user.id" :user="user"></user-card>
    </ul>
    <div class="aside close">
      <div class="aside__close" @click="openFilter"></div>
      <h2 class="filter__title">Filter par</h2>
      <div class="filter__name__job">
        <div class="filter__name active" @click="changeFilter('name')">Nom</div>
        <div class="filter__job" @click="changeFilter('job')">Profession</div>
      </div>
      <div class="filter__alphabet"></div>
      <input
        type="text"
        name="filter"
        class="filter__input"
        id="filter"
        v-model="filter"
        autocomplete="off"
        :placeholder="placeholder"
      />
    </div>
    <div class="aside__button filter" @click="openFilter"></div>
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
    return {
      filteredBy: "name",
      filter: ""
    };
  },
  methods: {
    changeFilter(type) {
      const items = document.querySelectorAll(".filter__name__job div");
      items.forEach(item => {
        item.classList.remove("active");
      });
      const newFocus = document
        .querySelector(".filter__" + type)
        .classList.add("active");

      this.filteredBy = type;
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
    ...mapState(["allJob", "allPractitioner"]),
    filteredByName() {
      if (this.filter.length === 0) {
        return this.allPractitioner;
      } else {
        return this.allPractitioner.filter(practitioner => {
          return practitioner.name
            .toLowerCase()
            .match(this.filter.toLowerCase());
        });
      }
    },
    filteredByJob() {
      if (this.filter.length === 0) {
        return this.allPractitioner;
      } else {
        return this.allPractitioner.filter(practitioner => {
          return practitioner.job.name
            .toLowerCase()
            .match(this.filter.toLowerCase());
        });
      }
    },
    placeholder() {
      if (this.filteredBy === "name") {
        return "Nom";
      } else {
        return "Profession";
      }
    }
  },
  mounted() {
    this.$store.dispatch("setAllJob").then(() => {
      this.$store.dispatch("setAllPractitioner");
    });
  }
};
</script>
