<script setup>
import LayoutMain from "@/layouts/LayoutMain.vue";
import UserGameList from "@/components/Elements/UserGameList/GameList.vue";
import { useGameListsStore } from "@/stores/games/gameListStore";
import { onMounted } from "vue";
import Loader from "@/components/Elements/Loader.vue";

const props = defineProps({
  userId: {
    type: String,
    required: true,
  },
});

const gameListStore = useGameListsStore();
onMounted(() => {
  gameListStore.getLists(props.userId);
});
</script>

<template>
  <LayoutMain>
    <Loader v-if="gameListStore.isLoading" />
    <UserGameList v-else :lists="gameListStore.lists" />
  </LayoutMain>
</template>

<style scoped></style>
