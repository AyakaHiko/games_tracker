<script setup>
import SectionFullScreen from "@/components/Elements/SectionFullScreen.vue";
import CardBox from "@/components/Elements/CardBox/CardBox.vue";
import BaseButton from "@/components/Elements/BaseButton.vue";
import BaseButtons from "@/components/Elements/BaseButtons.vue";
import LayoutGuest from "@/layouts/LayoutGuest.vue";
</script>

<template>
  <LayoutGuest>
    <SectionFullScreen v-slot="{ cardClass }" bg="pinkRed">
      <CardBox :class="cardClass">
        <div class="space-y-3">
          <h1 class="text-2xl">Unhandled exception</h1>

          <p>An Error Occurred</p>
        </div>

        <template #footer>
          <BaseButtons>
            <BaseButton label="Done" to="/home" color="danger" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
