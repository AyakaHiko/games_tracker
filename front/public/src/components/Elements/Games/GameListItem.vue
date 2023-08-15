<script setup>
import {
  mdiCheckCircleOutline,
  mdiHeartPlusOutline,
  mdiPlaylistPlus,
} from "@mdi/js/commonjs/mdi";
import BaseButton from "@/components/Elements/BaseButton.vue";
import { useGameListsStore } from "@/stores/games/gameListStore";
import { toast } from "vue3-toastify";
import { useMainStore } from "@/stores/main";

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});

const gameListsStore = useGameListsStore();
const addToList = (listType) => {
  const user = useMainStore().user;
  let list;
  switch (listType) {
    case "wishlist":
      list = user.wishlistId;
      break;
    case "completed":
      list = user.completedListId;
      break;
    case "uncompleted":
      list = user.uncompletedListId;
      break;
    default:
      toast.error("Something wrong");
      return;
  }

  gameListsStore.addGameToList(props.item.id, list).then((response) => {
    if (gameListsStore.isError) {
      toast.error(gameListsStore.error);
      gameListsStore.isError = false;
    } else toast.success(response.message);
  });
};
</script>

<template>
  <li class="list-group-item">
    <div class="flex align-top mb-1.5 border-gray-500 border-[1px] w-100">
      <div class="mr-0.5">
        <img
          class="object-cover max-w-md h-auto"
          :src="item.background_image"
          alt="{{item.slug}}"
        />
      </div>
      <div class="game-description">
        <h3 class="mb-3">
          <router-link
            :to="{
              name: 'game',
              params: { gameId: props.item.id },
            }"
          >
            {{ props.item.name }}
          </router-link>
        </h3>
        <p class="font-bold">Genres:</p>
        <ul class="list-group mb-3">
          <li v-for="genre in item.genres" :key="genre" class="list-group-item">
            {{ genre.name }}
          </li>
        </ul>

        <p class="font-bold mb-3">
          Metacritic: <b>{{ item.metacritic }}</b>
        </p>
        <div v-if="useMainStore().isLogin">
          <BaseButton
            :outline="true"
            :icon-size="18"
            :icon="mdiHeartPlusOutline"
            @click="addToList('wishlist')"
          />
          <BaseButton
            :outline="true"
            :icon-size="18"
            :icon="mdiCheckCircleOutline"
            @click="addToList('completed')"
          />
          <BaseButton
            :outline="true"
            :icon-size="18"
            :icon="mdiPlaylistPlus"
            @click="addToList('uncompleted')"
          />
        </div>
      </div>
    </div>
  </li>
</template>

<style scoped>
.game-description {
  width: 100%;
}
</style>
