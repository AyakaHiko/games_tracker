<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import LayoutMain from "@/layouts/LayoutMain.vue";
import Loader from "@/components/Elements/Loader.vue";
import { useGameDetailsStore } from "@/stores/games/gameDetails";

const props = defineProps({
  gameId: {
    type: String,
    required: true,
  },
});

const gameStore = useGameDetailsStore();
const router = useRouter();

onMounted(async () => {
  gameStore.getGame(props.gameId).catch(() => {
    router.push("/error");
  });
});
</script>

<template>
  <LayoutMain>
    <Loader v-if="gameStore.isLoading" />
    <div v-else>
      <img
        class="object-cover"
        :src="gameStore.detailedGame.background_image_additional"
        :alt="gameStore.detailedGame.game?.slug"
      />
      <div>
        <h1>{{ gameStore.detailedGame.name_original }}</h1>
        <hr />
        <div v-html="gameStore.detailedGame.description"></div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <b>Website:</b>
            <a :href="gameStore.detailedGame.website" target="_blank">{{
              gameStore.detailedGame.website
            }}</a>
          </li>
          <li class="list-group-item">
            <b>Released:</b>
            <span>{{ gameStore.detailedGame.game?.released }}</span>
          </li>
          <li class="list-group-item">
            <b>Rating:</b>
            <span>{{ gameStore.detailedGame.game?.rating }}</span>
          </li>
          <li class="list-group-item">
          <b>Metacritic:</b>
            <span>{{ gameStore.detailedGame.game?.metacritic }}</span>
          </li>
        </ul>
      </div>
    </div>
  </LayoutMain>
</template>

<style scoped>

</style>
