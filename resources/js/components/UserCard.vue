<template>
  <li class="userCard">
    <div v-if="user.profilPic" class="userCard__img--true">
      <img :src="'../images/profiles/' + user.profilPic" alt />
    </div>
    <div class="userCard__img" v-else></div>
    <div class="userCard__name">
      <a href @click.prevent.stop="profilLink(user.id)">{{user.name}}</a>
    </div>
    <div class="userCard__job">{{user.job.name}}</div>
    <div class="useCard__address">{{user.address}}</div>
    <div class="userCard__icons">
      <a
        :href="'mailto:' + user.email"
        :title="'envoyer un email à ' + user.name"
        class="userCard__icons__link userCard__icons__link--mail"
      >
        <span class="sr-only">envoyer un email à {{user.name}}</span>
      </a>
      <a
        :href="'tel:' + user.gsm"
        :title="'téléphoner a ' + user.name"
        class="userCard__icons__link userCard__icons__link--phone"
      >
        <span class="sr-only">téléphoné à {{user.name}}</span>
      </a>
    </div>
  </li>
</template>
<script>
import router from "../router.js";
export default {
  name: "UserCard",
  data() {
    return {};
  },
  props: {
    user: Object
  },
  methods: {
    profilLink(id) {
      router.push({ name: "praticien", params: { id: id } });
      window.scrollTo(0, 0);
    }
  },
  props: {
    user: Object
  }
};
</script>
