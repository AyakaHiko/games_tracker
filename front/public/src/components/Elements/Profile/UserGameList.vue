<script setup>
import UserGameListItem from "@/components/Elements/Profile/UserGameListItem.vue";

const props = defineProps({
  lists: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <ul class="ml-1">
    <UserGameListItem v-for="list in props.lists" :key="list.id" :item="list" />
  </ul>
</template>

<style scoped></style>
