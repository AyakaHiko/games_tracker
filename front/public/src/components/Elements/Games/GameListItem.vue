<script setup>
defineProps({
  item: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <li>
    <component
      :to="item.to ?? null"
      :href="item.href ?? null"
      :target="item.target ?? null"
    >
      <span class="grow text-ellipsis line-clamp-1">{{ item.label }}</span>
    </component>
  </li>
</template>

<style scoped></style>
