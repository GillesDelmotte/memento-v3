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
    <h1 class="userProfil__name">{{person.name}}</h1>
    <span class="userProfil__job" v-if="person.job">
      {{person.job.name}}
      <i
        class="modifyIcon"
        title="modifier ma profession"
        v-if="userProfil"
        @click="clickIcon('Profession', 'text', 'job', person.job.name)"
      ></i>
    </span>
    <span class="userProfil__job" v-if="!person.job && userProfil">
      Votre profession
      <i
        class="modifyIcon"
        title="modifier ma profession"
        @click="clickIcon('Profession', 'text', 'job')"
      ></i>
    </span>
    <div class="userProfil__infos">
      <div class="userProfil__info">
        <div class="userProfil__info__label">
          Gsm
          <i
            class="modifyIcon"
            v-if="userProfil"
            title="modifier mon numero de téléphone"
            @click="clickIcon('Gsm', 'tel', 'gsm', person.gsm)"
          ></i>
        </div>
        <div class="userProfil__info__content">{{person.gsm}}</div>
      </div>
      <div class="userProfil__info">
        <div class="userProfil__info__label">
          Adresse
          <i
            class="modifyIcon"
            v-if="userProfil"
            title="modifier mon adresse"
            @click="clickIcon('Adresse', 'text', 'address', person.address)"
          ></i>
        </div>
        <div class="userProfil__info__content">{{person.address}}</div>
      </div>
      <div class="userProfil__info">
        <div class="userProfil__info__label">
          Description
          <i
            class="modifyIcon"
            v-if="userProfil"
            title="modifier ma description"
            @click="clickIcon('Description', 'description', 'description')"
          ></i>
        </div>
        <div class="userProfil__info__content">{{person.description}}</div>
      </div>
      <div class="userProfil__info--buttons" v-if="userProfil">
        <!-- <div class="radioButton">
          <input type="checkbox" name="open" id="open" class="radioButton__input sr-only" />
          <label for="open" class="radioButton__bgc">
            <label for="open" class="radioButton__dot"></label>
          </label>
          <label
            for="open"
            class="radioButton__label"
          >Autoriser mon profil à être vu par les personnes que je consulte</label>
        </div>-->
        <div class="radioButton">
          <input type="checkbox" name="indexed" id="indexed" class="radioButton__input sr-only" />
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
        <label for="popup" class="popup__window__label">{{popupLabel}}</label>
        <textarea
          name
          v-if="popupType === 'description'"
          id
          class="popup__window__textarea"
          @keyup.enter="updateProfil"
        >{{person.description}}</textarea>
        <input
          :type="popupType"
          :name="popupName"
          id="popup"
          class="popup__window__input"
          :value="popupValue"
          @keyup.enter="updateProfil"
          v-else
        />
        <button class="popup__window__save" @click="updateProfil">Enregistrer</button>
      </div>
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
      image: ""
    };
  },
  props: {
    person: Object,
    userProfil: Boolean
  },
  methods: {
    clickIcon(label, type, name, test) {
      this.popupLabel = label;
      this.popupType = type;
      this.popupName = name;
      this.popupValue = test;
      document.querySelector(".popup").classList.add("open");
      document.querySelector("body").classList.add("freeze");
    },
    updateProfil() {
      if (this.popupType !== "description") {
        var value = document.querySelector(".popup__window__input").value;
      } else {
        var value = document.querySelector(".popup__window__textarea").value;
      }
      window.axios
        .post("/updateProfile", { column: this.popupName, value: value })
        .then(response => {
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
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
