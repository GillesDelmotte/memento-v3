<template>
  <div class="userProfil">
    <div v-if="userProfil">
      <label for="imageFile" class="userProfil__pic" v-if="person.profilPic">
        <img :src="'../images/profiles/' + person.profilPic" alt />
      </label>
      <label class="userProfil__img--true" for="imageFile" v-else>
        <div class="cross__first"></div>
        <div class="cross__second"></div>
      </label>
      <label for="imageFile" class="profile__img"></label>
      <input
        type="file"
        id="imageFile"
        accept="image/*"
        class="imageFile sr-only"
        v-on:change="uploadImage"
      />
    </div>
    <div v-else>
      <div v-if="person.profilPic" class="userProfil__pic">
        <img :src="'../images/profiles/' + person.profilPic" alt />
      </div>
      <div class="userProfil__img--false" v-else></div>
    </div>
    <h1 class="userProfil__name">
      {{person.name}}
      <i
        class="modifyIcon"
        v-if="userProfil"
        title="modifier ma description"
        @click="clickIcon"
      ></i>
    </h1>
    <span class="userProfil__job" v-if="person.job && person.create">{{person.job.name}}</span>
    <span class="userProfil__job" v-if="!person.job && userProfil && person.create">Votre profession</span>
    <div :class="person.create ? 'userProfil__infos' : 'userProfil__infos create'">
      <div class="userProfil__info">
        <div class="userProfil__info__label">Gsm</div>
        <div class="userProfil__info__content">{{person.gsm}}</div>
      </div>
      <div class="userProfil__info">
        <div class="userProfil__info__label">Adresse</div>
        <div class="userProfil__info__content">{{person.address}}</div>
      </div>
      <div class="userProfil__info" v-if="person.create">
        <div class="userProfil__info__label">Description</div>
        <div class="userProfil__info__content">{{person.description}}</div>
      </div>
      <div class="userProfil__info" v-if="userProfil">
        <div class="userProfil__info__label">Thême de l'applicaction</div>
        <div class="userProfil__info__colorPicker">
          <div
            @click="changeTheme('black')"
            :class="person.theme === 'black' ? 'color black selected' : 'color black'"
          ></div>
          <div
            @click="changeTheme('green')"
            :class="person.theme === 'green' ? 'color green selected' : 'color green'"
          ></div>
          <div
            @click="changeTheme('red')"
            :class="person.theme === 'red' ? 'color red selected' : 'color red'"
          ></div>
          <div
            @click="changeTheme('brown')"
            :class="person.theme === 'brown' ? 'color brown selected' : 'color brown'"
          ></div>
        </div>
      </div>
      <div class="userProfil__info--buttons" v-if="userProfil">
        <div class="radioButton">
          <input
            type="checkbox"
            name="create"
            :value="person.create"
            :checked="person.create ? 'checked' : ''"
            v-on:change="updateCheck('create', 'create')"
            id="create"
            class="radioButton__input sr-only"
          />
          <label for="create" class="radioButton__bgc">
            <label for="create" class="radioButton__dot"></label>
          </label>
          <label for="create" class="radioButton__label">Je veux pouvoir créer des agendas</label>
        </div>
      </div>
      <div class="userProfil__info--buttons" v-if="userProfil && person.create">
        <div class="radioButton">
          <input
            type="checkbox"
            name="indexed"
            :value="person.schedule"
            :checked="person.schedule ? 'checked' : ''"
            v-on:change="updateCheck('schedule', 'indexed')"
            id="indexed"
            class="radioButton__input sr-only"
          />
          <label for="indexed" class="radioButton__bgc">
            <label for="indexed" class="radioButton__dot"></label>
          </label>
          <label for="indexed" class="radioButton__label">Je veux que mon agenda soit indexé</label>
        </div>
      </div>
    </div>
    <div class="popup" @click="closePopupWithBackground($event)">
      <div class="popup__window">
        <button class="popup__window__close sr-only" @click="closePopup">close</button>
        <span class="popup__window__close--cross" @click="closePopup"></span>
        <h2 class="popup__window__title">Édition de mon profil</h2>
        <div :class="'popup__window__input ' + person.theme" v-if="person.create">
          <label for="job">Profession&nbsp;:</label>
          <input type="tel" name="job" id="job" v-model="job" />
          <div :class="'popup__window__input__bgc ' + person.theme"></div>
        </div>
        <div :class="'popup__window__input ' + person.theme">
          <label for="gsm">Gsm&nbsp;:</label>
          <input type="tel" name="gsm" id="gsm" v-model="gsm" />
          <div :class="'popup__window__input__bgc ' + person.theme"></div>
        </div>
        <div :class="'popup__window__input ' + person.theme">
          <label for="address">Adresse&nbsp;:</label>
          <input type="tel" name="address" id="address" v-model="address" />
          <div :class="'popup__window__input__bgc ' + person.theme"></div>
        </div>
        <div
          :class="'popup__window__input popup__window__input--textarea ' + person.theme"
          v-if="person.create"
        >
          <label for="desc">Description&nbsp;:</label>
          <textarea name="desc" id="desc" cols="10" rows="3" v-model="desc"></textarea>
          <div :class="'popup__window__input__bgc ' + person.theme"></div>
        </div>
        <button class="popup__window__save" @click="updateProfil">Enregistrer</button>
      </div>
    </div>
    <div class="error" v-if="error != ''" @click="deleteError">
      <span class="error__cross" @click="deleteError"></span>
      {{error}}
    </div>
  </div>
</template>
<script>
import store from "../store.js";
import { mapState } from "vuex";
import { mapMutations } from "vuex";

export default {
  name: "UserInfos",
  data() {
    return {
      popupLabel: "",
      popupType: "",
      popupName: "",
      popupValue: "",
      image: "",
      error: "",
      job: "",
      address: "",
      desc: "",
      gsm: ""
    };
  },
  props: {
    person: Object,
    userProfil: Boolean
  },
  methods: {
    clickIcon() {
      const nav = document.querySelector(".nav");
      nav.classList.remove("responsive__open");
      if (this.person.create === 1) {
        const filter = document.querySelector(".aside");
        filter.classList.add("close");
      }

      this.job = this.person.job.name;
      this.address = this.person.address;
      this.desc = this.person.description;
      this.gsm = this.person.gsm;

      document.querySelector(".popup").classList.add("open");
      document.querySelector("body").classList.add("freeze");
    },
    updateProfil() {
      var data = {
        job: this.job,
        description: this.desc,
        gsm: this.gsm,
        address: this.address,
        type: "all"
      };
      //console.log(data);
      window.axios
        .post("/updateProfile", data)
        .then(response => {
          console.log(response.data);
          this.$store.dispatch("setCurrentUser");
          document.querySelector(".popup").classList.remove("open");
          document.querySelector("body").classList.remove("freeze");
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
    },
    closePopup() {
      document.querySelector(".popup").classList.remove("open");
      document.querySelector("body").classList.remove("freeze");
    },
    closePopupWithBackground(e) {
      const bgc = document.querySelector(".popup");
      if (e.target === bgc) {
        bgc.classList.remove("open");
        document.querySelector("body").classList.remove("freeze");
      }
    },
    uploadImage() {
      var formData = new FormData();
      var imagefile = document.querySelector(".imageFile");
      formData.append("image", imagefile.files[0]);
      window.axios
        .post("/image/store", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.$store.dispatch("setCurrentUser");
          if (response.data.error) {
            this.error = response.data.error;
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteError() {
      this.error = "";
    },
    updateCheck(column, input) {
      var bool = document.getElementById(input).checked;
      var value = bool.toString();
      if (value === "false") {
        value = 0;
      } else {
        value = 1;
      }

      window.axios
        .post("/updateProfile", { column: column, value: value, type: "check" })
        .then(response => {
          console.log(response.data);
          this.$store.dispatch("setCurrentUser");
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
    },
    changeTheme(color) {
      window.axios
        .post("/updateTheme", { color: color })
        .then(response => {
          this.$store.dispatch("setCurrentUser");
        })
        .catch(function(error) {
          console.log(error.response.data.message);
        });
    }
  }
};
</script>
