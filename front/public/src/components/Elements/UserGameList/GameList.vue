<script setup>
import UserGameListItem from "@/components/Elements/UserGameList/GameListItem.vue";

const props = defineProps({
  lists: {
    type: Object,
    required: true,
  },
  isCurrentUser: {
    type: Boolean,
  },
});
</script>

<template>
  <ul class="ml-1">
    <UserGameListItem
      v-for="list in props.lists"
      :key="list.id"
      :isCurrentUser="props.isCurrentUser"
      :item="list"
    />
  </ul>
</template>

<style scoped></style>
