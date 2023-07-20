<script setup>

import GameListItem from "@/components/Elements/Games/GameListItem.vue";
import AsideMenuItem from "@/components/Elements/AsideMenu/AsideMenuItem.vue";

defineProps({
  games: {
    type: Array,
    required: true,
  },
});

</script>

<template>
<ul>
  <GameListItem
    v-for="(item, index) in games"
    :key="index"
    :item="item"
  />
</ul>
</template>

<style scoped>

</style>
