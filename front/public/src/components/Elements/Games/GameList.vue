<script setup>
import GameListItem from "@/components/Elements/Games/GameListItem.vue";
import { useGamesStore } from "@/stores/games/games";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";
import Loader from "@/components/Elements/Loader.vue";
import NavBarItemPlain from "@/components/Elements/NavBar/NavBarItemPlain.vue";
import FormControl from "@/components/Elements/Form/FormControl.vue";

const gamesStore = useGamesStore();
let page = ref(1);
let pageCount = ref();
onMounted(() => {
  gamesStore.getData(page.value).then((response) => {
    pageCount.value = response.result.last_page;
  });
});
const getGames = async () => {
  try {
    await gamesStore.getData(page.value);
  } catch (err) {
    toast.error(err.message);
  }
};
</script>

<template>
  <NavBarItemPlain use-margin>
    <FormControl
      placeholder="Search (ctrl+k)"
      ctrl-k-focus
      transparent
      borderless
    />
  </NavBarItemPlain>
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
