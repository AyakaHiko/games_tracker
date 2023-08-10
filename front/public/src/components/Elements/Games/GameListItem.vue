<script setup>
import {
  mdiCheckCircleOutline,
  mdiHeartPlusOutline,
  mdiPlaylistPlus,
} from "@mdi/js/commonjs/mdi";
import BaseButton from "@/components/Elements/BaseButton.vue";

defineProps({
  item: {
    type: Object,
    required: true,
  },
});

const addToList = () => {

};
</script>

<template>
  <li>
    <div class="flex align-top mb-1.5 border-gray-500 border-[1px] w-100">
      <div class="mr-0.5">
        <img
          class="object-cover max-w-md h-auto"
          :src="item.background_image"
          alt="{{item.slug}}"
        />
      </div>
      <div class="game-description">
        <h4>{{ item.name }}</h4>
        <hr />
        <p class="font-bold">Genres:</p>
        <ul v-for="genre in item.genres" :key="genre" class="list-group">
          <li class="list-group-item">
            {{ genre.name }}
          </li>
        </ul>
        <hr />

        <p class="font-bold">
          Metacritic: <b>{{ item.metacritic }}</b>
        </p>
        <BaseButton
          :outline="true"
          :icon-size="18"
          :icon="mdiPlaylistPlus"
          @click="addToList"
        />
        <BaseButton
          :outline="true"
          :icon-size="18"
          :icon="mdiHeartPlusOutline"
          href="#"
        />
        <BaseButton
          :outline="true"
          :icon-size="18"
          :icon="mdiCheckCircleOutline"
          href="#"
        />
      </div>
    </div>
  </li>
</template>

<style scoped>
.game-description {
  width: 100%;
}
</style>
