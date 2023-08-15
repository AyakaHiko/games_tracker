<script setup>

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <h1>{{item.name}}</h1>

</template>

<style scoped></style>
