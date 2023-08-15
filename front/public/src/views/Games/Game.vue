<script setup>
import {onMounted} from "vue";
import {useGamesStore} from "@/stores/games/games";

const props = defineProps({
  gameId: {
    type: String,
    required: true,
  },
});

let game={};
onMounted(()=>{
  useGamesStore().getGame(props.gameId);
})
</script>

<template>
<div>
  <h1>{{props.gameId}}</h1>
</div>
</template>

<style scoped></style>
