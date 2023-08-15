<script setup>
import GameListItem from "@/components/Elements/Games/GameListItem.vue";
import { useGamesStore } from "@/stores/games/games";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";
import Loader from "@/components/Elements/Loader.vue";
import FormControl from "@/components/Elements/Form/FormControl.vue";

const gamesStore = useGamesStore();
let page = ref(1);
let pageCount = ref();

const initGames = () => {
  gamesStore.getData(page.value).then((response) => {
    pageCount.value = response.result.last_page;
  });
};
const getGames = async () => {
  try {
    await gamesStore.getData(page.value);
  } catch (err) {
    toast.error(err.message);
  }
};

const handleSearchEnter = (event) => {
  event.preventDefault();
  gamesStore.search = event.target.value;
  initGames();
};
onMounted(() => {
  initGames();
});
</script>

<template>
  <FormControl
    placeholder="Search (ctrl+k)"
    ctrl-k-focus
    transparent
    @keyup.enter="handleSearchEnter"
    @blur="handleSearchEnter"
  />
  <Loader v-if="gamesStore.isLoading" />
  <ul v-else class="ml-1 list-group-flush">
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
