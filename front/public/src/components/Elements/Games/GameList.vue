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

let page = ref(2);
let games = ref(gamesStore.games)
let pageCount = ref(gamesStore.pageSize);
const getGames = async () => {
  try {
    console.log(page);
    await gamesStore.getGames(page.value);
    console.log(games);
    console.log(gamesStore.games);
  } catch (err) {
    toast.error(err.message);
  }
};
</script>

<template>
  <Loader v-if="gamesStore.isLoading" />
  <ul v-else>
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
      :range-size="1"
      active-color="#337aff"
      @update:modelValue="getGames"
    />
  </div>
</template>

<style scoped></style>
