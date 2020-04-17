<template>
  <li class="userCard">
    <div class="userCard__img"></div>
    <div class="userCard__name">{{user.name}}</div>
    <div class="userCard__job">{{user.job.name}}</div>
    <div class="useCard__address">{{user.address}}</div>
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
