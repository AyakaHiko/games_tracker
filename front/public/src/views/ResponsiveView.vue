<script setup>
import SectionTitle from "@/components/Elements/SectionTitle.vue";
import SectionMain from "@/components/Elements/SectionMain.vue";
import LayoutMain from "@/layouts/LayoutMain.vue";
</script>

<template>
  <LayoutMain>
    <SectionTitle first>Mobile & Tablet</SectionTitle>

    <SectionMain>
      <div
        class="md:w-10/12 shadow-2xl md:mx-auto rounded-3xl border-8 border-white overflow-hidden"
      >
        <img
          src="https://static.justboil.me/templates/one/one-tailwind-vue-mobile.png"
          class="block"
        />
      </div>
    </SectionMain>

    <SectionTitle>Small laptop 1024px</SectionTitle>

    <SectionMain>
      <div
        class="md:w-10/12 shadow-2xl md:mx-auto rounded-3xl border-8 border-white overflow-hidden"
      >
        <img
          src="https://static.justboil.me/templates/one/one-tailwind-vue-1024.png"
          class="block"
        />
      </div>
    </SectionMain>

    <SectionMain>
      <div
        class="md:w-10/12 shadow-2xl md:mx-auto rounded-3xl border-8 border-white overflow-hidden"
      >
        <img
          src="https://static.justboil.me/templates/one/one-tailwind-vue-1024-menu-open.png"
          class="block"
        />
      </div>
    </SectionMain>

    <SectionTitle>Laptop & desktop</SectionTitle>

    <SectionMain>
      <div
        class="md:w-10/12 shadow-2xl md:mx-auto rounded-3xl border-8 border-white overflow-hidden"
      >
        <img
          src="https://static.justboil.me/templates/one/one-tailwind-vue-widescreen.png"
          class="block"
        />
      </div>
    </SectionMain>
  </LayoutMain>
</template>
