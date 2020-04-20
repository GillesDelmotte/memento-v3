<template>
  <div class="userProfil">
    <h1 class="userProfil__name">{{person.name}}</h1>
    <span class="userProfil__job" v-if="person.job">
      {{person.job.name}}
      <i class="modifyIcon" title="modifier ma profession" v-if="userProfil"></i>
    </span>
    <span class="userProfil__job" v-if="!person.job && userProfil">
      Votre profession
      <i class="modifyIcon" title="modifier ma profession"></i>
    </span>
    <div class="userProfil__infos">
      <div class="userProfil__info">
        <div class="userProfil__info__label">
          Gsm
          <i class="modifyIcon" v-if="userProfil" title="modifier mon numero de téléphone"></i>
        </div>
        <div class="userProfil__info__content">{{person.gsm}}</div>
      </div>
      <div class="userProfil__info">
        <div class="userProfil__info__label">
          Adresse
          <i class="modifyIcon" v-if="userProfil" title="modifier mon adresse"></i>
        </div>
        <div class="userProfil__info__content">{{person.address}}</div>
      </div>
      <div class="userProfil__info">
        <div class="userProfil__info__label">
          Description
          <i class="modifyIcon" v-if="userProfil" title="modifier ma description"></i>
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
  </div>
</template>
<script>
export default {
  name: "UserInfos",
  data() {
    return {};
  },
  props: {
    person: Object,
    userProfil: Boolean
  }
};
</script>
