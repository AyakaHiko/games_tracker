<script setup>
import LayoutMain from "@/layouts/LayoutMain.vue";
import UserGameList from "@/components/Elements/UserGameList/GameList.vue";
import { useGameListsStore } from "@/stores/games/gameListStore";
import { computed, onMounted } from "vue";
import Loader from "@/components/Elements/Loader.vue";
import { useMainStore } from "@/stores/main";

const props = defineProps({
  userId: {
    type: String,
    required: true,
  },
});

const gameListStore = useGameListsStore();
const isCurrentUser = useMainStore().user.id === props.userId;
onMounted(() => {
  gameListStore.getLists(props.userId);
});
</script>

<template>
  <LayoutMain>
    <Loader v-if="gameListStore.isLoading" />
    <UserGameList
      v-else
      :isCurrentUser="isCurrentUser"
      :lists="gameListStore.lists"
    />
  </LayoutMain>
</template>

<style scoped></style>
