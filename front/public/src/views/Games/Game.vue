<script setup>
const props = defineProps({
  gameId: {
    type: String,
    required: true,
  },
});
</script>

<template>
<div>
  <h1>{{props.gameId}}</h1>
</div>
</template>

<style scoped></style>
