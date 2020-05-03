<template>
  <div class="header">
    <div class="header__logo">M</div>
    <div class="header__title">{{title}}</div>
  </div>
</template>

<script>
export default {
  name: "HeaderComponent",
  props: ["title"]
};
</script>
