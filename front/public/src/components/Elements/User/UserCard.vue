<script setup>
import { computed, ref } from "vue";
import { useMainStore } from "@/stores/main";
import { mdiCheckDecagram } from "@mdi/js";
import BaseLevel from "@/components/Elements/BaseLevel.vue";
import UserAvatarCurrentUser from "@/components/Elements/User/UserAvatarCurrentUser.vue";
import CardBox from "@/components/Elements/CardBox/CardBox.vue";
import FormCheckRadio from "@/components/Elements/Form/FormCheckRadio.vue";
import PillTag from "@/components/Elements/PillTag/PillTag.vue";

const mainStore = useMainStore();

const userName = computed(() => mainStore.user.login);

// const userSwitchVal = ref(false);
</script>

<template>
  <CardBox>
    <BaseLevel type="justify-around lg:justify-center">
      <UserAvatarCurrentUser class="lg:mx-12 avatar" />
      <div class="space-y-3 text-center md:text-left lg:mx-12">
        <div class="flex justify-center md:block">
<!--          <FormCheckRadio-->
<!--            v-model="userSwitchVal"-->
<!--            name="notifications-switch"-->
<!--            type="switch"-->
<!--            label="Notifications"-->
<!--            :input-value="true"-->
<!--          />-->
        </div>
        <h1 class="text-2xl">
          Howdy, <b>{{ userName }}</b
          >!
        </h1>
<!--        <p>Last login <b>12 mins ago</b> from <b>127.0.0.1</b></p>-->
        <div class="flex justify-center md:block">
          <PillTag  label="Verified" color="info" :icon="mdiCheckDecagram" />
        </div>
      </div>
    </BaseLevel>
  </CardBox>
</template>
<style>
.avatar img{
  height: 100px;
  width: auto;
}
</style>
