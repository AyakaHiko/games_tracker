<script setup>
import { useMainStore } from "@/stores/main";
import UserAvatar from "@/components/Elements/User/UserAvatar.vue";

const mainStore = useMainStore();
</script>

<template>
  <UserAvatar :username="mainStore.user.login" :avatar="mainStore.user.avatar">
    <slot />
  </UserAvatar>
</template>
