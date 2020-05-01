<template>
  <li class="comment">
    <div v-if="comment.owner.profilPic" class="comment__ownerImg--true">
      <img :src="'../images/profiles/' + comment.owner.profilPic" alt />
    </div>
    <div class="comment__ownerImg" v-else></div>
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
