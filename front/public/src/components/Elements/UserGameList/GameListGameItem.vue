<script setup>
import BaseButton from "@/components/Elements/BaseButton.vue";
import { toast } from "vue3-toastify";
import { useGameListsStore } from "@/stores/games/gameListStore";
import { ref } from "vue";

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
  listId: {
    type: Number,
    required: true,
  },
  isCurrentUser: {
    type: Boolean,
  },
});

const gameListsStore = useGameListsStore();
const isDeleted = ref(false);
const removeGameFromList = () => {
  gameListsStore
    .removeGameFromList(props.item.id, props.listId)
    .then((response) => {
      if (gameListsStore.isError) {
        toast.error(gameListsStore.error);
        gameListsStore.isError = false;
      } else {
        isDeleted.value = true;
        toast.success(response.message);
      }
    });
};
</script>

<template>
  <li v-if="!isDeleted.value">
    <div class="flex card align-top mb-1.5 border-gray-500 border-[1px]">
      <img
        class="object-cover max-w-md h-auto"
        :src="props.item.background_image"
        alt="{{props.item.name}}"
      />
      <span>
        <router-link
          :to="{
            name: 'game',
            params: { gameId: props.item.id },
          }"
        >
          {{ props.item.name }}
        </router-link>
      </span>
      <BaseButton
        v-if="props.isCurrentUser"
        class="h-12"
        :label="'Remove'"
        :color="'danger'"
        @click="removeGameFromList"
      />
    </div>
  </li>
</template>

<style scoped>
.card {
  display: inline-flex;
  flex-direction: column;
  width: 300px;
}
</style>
