<script setup>
import { reactive, ref } from "vue";
import { useMainStore } from "@/stores/main";
import {
  mdiAccount,
  mdiMail,
  mdiAsterisk,
  mdiFormTextboxPassword,
  mdiGithub,
} from "@mdi/js";
import SectionMain from "@/components/Elements/SectionMain.vue";
import CardBox from "@/components/Elements/CardBox/CardBox.vue";
import BaseDivider from "@/components/Elements/BaseDivider.vue";
import FormField from "@/components/Elements/Form/FormField.vue";
import FormControl from "@/components/Elements/Form/FormControl.vue";
import FormFilePicker from "@/components/Elements/Form/FormFilePicker.vue";
import BaseButton from "@/components/Elements/BaseButton.vue";
import BaseButtons from "@/components/Elements/BaseButtons.vue";
import UserCard from "@/components/Elements/User/UserCard.vue";
import LayoutMain from "@/layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/components/Elements/SectionTitleLineWithButton.vue";
import { useProfileStore } from "@/stores/profile/profileStorage";
import Loader from "@/components/Elements/Loader.vue";

const mainStore = useMainStore();

const profileForm = reactive({
  login: mainStore.user.login,
  email: mainStore.user.email,
});

// const passwordForm = reactive({
//   password_current: "",
//   password: "",
//   password_confirmation: "",
// });

const submitProfile = () => {
  mainStore.updateUser(profileForm);
};
const selectedFile = ref(null);
const profileStore = useProfileStore();
const updateAvatar = () => {
  const formData = new FormData();
  formData.append("avatar", selectedFile.value);
  profileStore.updateAvatar(formData);
};
</script>

<template>
  <LayoutMain>
    <SectionMain>
      <UserCard class="mb-6" />
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <CardBox is-form @submit.prevent="updateAvatar">
          <FormField label="Avatar" help="Max 500kb">
            <FormFilePicker v-model="selectedFile" label="Upload" />
          </FormField>
          <template #footer>
            <Loader v-if="profileStore.isLoading" />
            <BaseButtons v-else>
              <BaseButton color="info" type="submit" label="Submit" />
            </BaseButtons>
          </template>
        </CardBox>
        <!--        <CardBox is-form @submit.prevent="submitProfile">-->
        <!--          <FormField label="Name" help="Required. Your name">-->
        <!--            <FormControl-->
        <!--              v-model="profileForm.login"-->
        <!--              :icon="mdiAccount"-->
        <!--              name="username"-->
        <!--              required-->
        <!--              autocomplete="username"-->
        <!--            />-->
        <!--          </FormField>-->
        <!--          <FormField label="E-mail" help="Required. Your e-mail">-->
        <!--            <FormControl-->
        <!--              v-model="profileForm.email"-->
        <!--              :icon="mdiMail"-->
        <!--              type="email"-->
        <!--              name="email"-->
        <!--              required-->
        <!--              autocomplete="email"-->
        <!--            />-->
        <!--          </FormField>-->

        <!--          <template #footer>-->
        <!--            <BaseButtons>-->
        <!--              <BaseButton color="info" type="submit" label="Submit" />-->
        <!--              <BaseButton color="info" label="Options" outline />-->
        <!--            </BaseButtons>-->
        <!--          </template>-->
        <!--        </CardBox>-->

        <!--        <CardBox is-form @submit.prevent="submitPass">-->
        <!--          <FormField-->
        <!--            label="Current password"-->
        <!--            help="Required. Your current password"-->
        <!--          >-->
        <!--            <FormControl-->
        <!--              v-model="passwordForm.password_current"-->
        <!--              :icon="mdiAsterisk"-->
        <!--              name="password_current"-->
        <!--              type="password"-->
        <!--              required-->
        <!--              autocomplete="current-password"-->
        <!--            />-->
        <!--          </FormField>-->

        <!--          <BaseDivider />-->

        <!--          <FormField label="New password" help="Required. New password">-->
        <!--            <FormControl-->
        <!--              v-model="passwordForm.password"-->
        <!--              :icon="mdiFormTextboxPassword"-->
        <!--              name="password"-->
        <!--              type="password"-->
        <!--              required-->
        <!--              autocomplete="new-password"-->
        <!--            />-->
        <!--          </FormField>-->

        <!--          <FormField-->
        <!--            label="Confirm password"-->
        <!--            help="Required. New password one more time"-->
        <!--          >-->
        <!--            <FormControl-->
        <!--              v-model="passwordForm.password_confirmation"-->
        <!--              :icon="mdiFormTextboxPassword"-->
        <!--              name="password_confirmation"-->
        <!--              type="password"-->
        <!--              required-->
        <!--              autocomplete="new-password"-->
        <!--            />-->
        <!--          </FormField>-->

        <!--          <template #footer>-->
        <!--            <BaseButtons>-->
        <!--              <BaseButton type="submit" color="info" label="Submit" />-->
        <!--              <BaseButton color="info" label="Options" outline />-->
        <!--            </BaseButtons>-->
        <!--          </template>-->
        <!--        </CardBox>-->
      </div>
    </SectionMain>
  </LayoutMain>
</template>
