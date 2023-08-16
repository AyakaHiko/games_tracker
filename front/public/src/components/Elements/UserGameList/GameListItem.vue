<script setup>
import GameListGameItem from "@/components/Elements/UserGameList/GameListGameItem.vue";

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
  isCurrentUser: {
    type: Boolean,
  },
});
</script>

<template>
  <h1>{{ props.item.name }}</h1>
  <ul >
    <GameListGameItem
      v-for="game in props.item.games"
      :key="game.id"
      :item="game"
      :isCurrentUser="props.isCurrentUser"
      :listId="props.item.id"
    />
  </ul>
</template>

<style scoped></style>
