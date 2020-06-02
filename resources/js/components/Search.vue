<template>
  <div>
    <div class="geolocate">
      <div class="geolocate__yes" v-if="displayGeoconfirm === true">
        <p>voulez-vous utilisez la geolocalisation pour recherher un praticien ?</p>
        <button @click="getLocation('true')">oui, je le veux</button>
      </div>
      <div class="geolocate__no">
        <p
          v-if="displayGeoconfirm === true"
        >si vous ne voulez pas, introduisez votre code postal ci-dessous pour faire une recherche</p>
        <div :class="'popup__window__input ' + currentUser.theme">
          <label for="postal">Code postal&nbsp;:</label>
          <input
            type="number"
            name="postal"
            id="postal"
            autocomplete="off"
            v-model="postcode"
            @keydown.enter="searchWithPostalCode"
          />
          <div :class="'popup__window__input__bgc ' + currentUser.theme"></div>
        </div>
        <button @click="searchWithPostalCode">Rechercher</button>
      </div>
    </div>
    <div v-if="filteredBy === 'name' && this.filteredByName">
      <div
        class="emptySearch"
        v-if="displayGeoconfirm === false && this.filteredByName.length === 0"
      >il n‘y a pas de résultat avec votre recherche ( code postal : "{{postcode}}" et nom : "{{filter}}")</div>

      <ul class="userCards">
        <user-card v-for="user in filteredByName" :key="user.id" :user="user"></user-card>
      </ul>
    </div>
    <div v-if="filteredBy === 'job' && this.filteredByJob">
      <div
        class="emptySearch"
        v-if="displayGeoconfirm === false && this.filteredByJob.length === 0"
      >il n‘y a pas de résultat avec votre recherche ( code postal : "{{postcode}}" et profession : "{{filter}}")</div>

      <ul class="userCards">
        <user-card v-for="user in filteredByJob" :key="user.id" :user="user"></user-card>
      </ul>
    </div>
    <div :class="'aside close ' + currentUser.theme">
      <div class="aside__close" @click="openFilter"></div>
      {{warning}}
      <h2 class="filter__title">Filtré par</h2>
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
      filter: "",
      warning: "",
      increase: 5,
      limit: 10,
      componentReady: false,
      scrolledToBottom: false,
      coord: null,
      postcode: null,
      newPostalCode: null,
      displayGeoconfirm: false
      //   test: null,
      //   locations: [
      //     { name: "bruxelles", min: 1000, max: 1299 },
      //     { name: "Brabant wallon", min: 1300, max: 1499 },
      //     { name: "Brabant flamand", min: 1500, max: 1999 },
      //     { name: "Anvers", min: 2000, max: 2999 },
      //     { name: "Brabant flamand", min: 3000, max: 3499 },
      //     { name: "Limbourg", min: 3000, max: 3999 },
      //     { name: "Liège", min: 4000, max: 4999 },
      //     { name: "Namur", min: 5000, max: 5999 },
      //     { name: "Hainaut", min: 6000, max: 6599 },
      //     { name: "Luxembourg", min: 6600, max: 6999 },
      //     { name: "Hainaut", min: 7000, max: 7999 },
      //     { name: "Flandre-Occidentale", min: 8000, max: 8999 },
      //     { name: "Flandre-Orientale", min: 9000, max: 9999 }
      //   ]
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
    },
    nextUsers() {
      this.$store.dispatch("setAllPractitioner", {
        limit: this.limit,
        postCode: this.postcode
      });
      this.limit = this.limit + this.increase;
    },
    scroll() {
      window.onscroll = () => {
        if (
          window.innerHeight + window.pageYOffset >=
          document.body.offsetHeight
        ) {
          this.nextUsers();
        }
      };
    },
    getLocation(changeGeo) {
      var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };
      this.$getLocation(options).then(coordinates => {
        this.coord = coordinates;
        window.axios
          .get(
            "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" +
              this.coord.lat +
              "&lon=" +
              this.coord.lng
          )
          .then(response => {
            this.postcode = response.data.address.postcode;
            this.$store.dispatch("setAllPractitioner", {
              limit: this.limit,
              postCode: this.postcode,
              changeGeo: changeGeo
            });
          });
        this.displayGeoconfirm = false;
      });
    },
    searchWithPostalCode() {
      this.$store.dispatch("setAllPractitioner", {
        limit: this.limit,
        postCode: this.postcode
      });
      this.displayGeoconfirm = false;
    }
  },
  computed: {
    ...mapState(["allJob", "allPractitioner", "currentUser"]),
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
      if (this.currentUser.geolocation) {
        this.getLocation("false");
      } else {
        this.displayGeoconfirm = true;
      }
      this.scroll();
    });
  }
};
</script>
