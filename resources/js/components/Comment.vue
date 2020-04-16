<template>
  <li class="comment">
    <div class="comment__ownerImg"></div>
    <div class="comment__owner">{{comment.owner.name}}</div>
    <p class="comment__content">{{comment.comment}}</p>
  </li>
</template>
<script>
export default {
  name: "Comment",
  data() {
    return {};
  },
  props: {
    comment: Object
  }
};
</script>
