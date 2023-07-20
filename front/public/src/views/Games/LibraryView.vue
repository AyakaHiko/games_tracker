<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import GameList from "@/components/Elements/Games/GameList.vue";
</script>

<template>
  <LayoutAuthenticated>
<GameList games=""></GameList>
  </LayoutAuthenticated>
</template>

<style scoped></style>
