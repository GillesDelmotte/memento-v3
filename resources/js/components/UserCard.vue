<template>
  <li class="userCard">
    <div class="userCard__img"></div>
    <div class="userCard__name">{{user.name}}</div>
    <div class="userCard__job">{{user.job.name}}</div>
    <div class="useCard__address">{{user.address}}</div>
    <div class="userCard__icons">
      <a
        href
        :title="'aller sur l‘horaire de ' + user.name"
        class="userCard__icons__link userCard__icons__link--schedule"
      >
        <span class="sr-only">aller sur l'horaire de {{user.name}}</span>
      </a>
      <a
        href
        :title="'envoyer un email à ' + user.name"
        class="userCard__icons__link userCard__icons__link--mail"
      >
        <span class="sr-only">envoyer un email à {{user.name}}</span>
      </a>
      <a
        href
        :title="'téléphoner a ' + user.name"
        class="userCard__icons__link userCard__icons__link--phone"
      >
        <span class="sr-only">téléphoné à {{user.name}}</span>
      </a>
    </div>
  </li>
</template>
<script>
export default {
  name: "UserCard",
  data() {
    return {};
  },
  props: {
    user: Object
  }
};
</script>
