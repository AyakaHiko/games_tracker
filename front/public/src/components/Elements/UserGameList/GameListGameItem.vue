<script setup>
const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <li>
    <div class="flex align-top mb-1.5 border-gray-500 border-[1px] w-100">
      <img
        class="object-cover max-w-md h-auto"
        :src="props.item.background_image"
        alt="{{props.item.name}}"
      />
      <span>
        <router-link
          :to="{
            name: 'game',
            params: { gameId: props.item.id, gameName:props.item.name },
          }"
        >
          {{ props.item.name }}
        </router-link>
      </span>
    </div>
  </li>
</template>

<style scoped></style>
