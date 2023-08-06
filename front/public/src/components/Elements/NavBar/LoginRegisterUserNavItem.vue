<script setup>
const props = defineProps({
  class: {
    type: String,
    default: "",
  },
});
</script>

<template :class="props.class">
  <router-link to="/login" class="mx-0.5">Log in</router-link>
  <router-link to="/registration" class="mx-0.5">Registration</router-link>
</template>

<style scoped></style>
