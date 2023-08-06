<script setup>
import NavBarItem from "@/components/Elements/NavBar/NavBarItem.vue";
import {useMainStore} from "@/stores/main";
import {useRouter} from "vue-router";

defineProps({
  menu: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(["menu-click"]);
const router = useRouter();
const menuClick = (event, item) => {
  if (item.isLogout) {
    useMainStore().logout();
    router.push("/login");
    return;
  }
  emit("menu-click", event, item);
};
</script>

<template>
  <NavBarItem
    v-for="(item, index) in menu"
    :key="index"
    :item="item"
    @menu-click="menuClick"
  />
</template>
