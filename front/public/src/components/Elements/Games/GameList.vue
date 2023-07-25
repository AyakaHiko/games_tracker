<script setup>
import GameListItem from "@/components/Elements/Games/GameListItem.vue";
import { useGamesStore } from "@/stores/games/games";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";
import Loader from "@/components/Elements/Loader.vue";

const gamesStore = useGamesStore();

onMounted(async () => {
  await getGames(page);
});

let page = ref(1);
let pageCount = gamesStore.getPageCount();
const getGames = async () => {
  try {
    await gamesStore.getGames(page.value);
  } catch (err) {
    toast.error(err.message);
  }
};
</script>

<template>
  <Loader v-if="gamesStore.isLoading" />
  <ul v-else class="ml-1">
    <GameListItem
      v-for="game in gamesStore.games"
      :key="game.id"
      :item="game"
    />
  </ul>
  <div class="flex items-center justify-center p-2">
    <v-pagination
      v-model="page"
      class="p-10"
      :pages="pageCount"
      :range-size="4"
      active-color="#337aff"
      @update:modelValue="getGames"
    />
  </div>
</template>

<style scoped></style>
