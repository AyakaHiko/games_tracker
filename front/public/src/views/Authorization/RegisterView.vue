<script setup>
import { reactive } from "vue";
import LayoutGuest from "@/layouts/LayoutGuest.vue";
import SectionFullScreen from "@/components/Elements/SectionFullScreen.vue";
import CardBox from "@/components/Elements/CardBox/CardBox.vue";
import { useRouter } from "vue-router";
import FormField from "@/components/Elements/Form/FormField.vue";
import FormControl from "@/components/Elements/Form/FormControl.vue";
import { mdiAccount, mdiAsterisk } from "@mdi/js";
import BaseButtons from "@/components/Elements/BaseButtons.vue";
import BaseButton from "@/components/Elements/BaseButton.vue";

import { useRegistrationStore } from "@/stores/authorization/registration";
import { toast } from "vue3-toastify";
import Loader from "@/components/Elements/Loader.vue";

const form = reactive({
  email: "timmy@tim.com",
  login: "Timmy",
  password: "password",
  confirmedPassword: "password",
});

const registrationStorage = useRegistrationStore();
const router = useRouter();

const submit = () => {
  if (form.password !== form.confirmedPassword) {
    toast.error("Passwords don't match");
    return false;
  }
  registrationStorage.doRegister(form).then(() => {
    if (registrationStorage.isError) {
      toast.error(registrationStorage.error);
      return false;
    } else {
      router.push("/login");
    }
  });
};
</script>

<template>
  <LayoutGuest>
    <SectionFullScreen v-slot="{ cardClass }" bg="purplePink">
      <CardBox :class="cardClass" is-form @submit.prevent="submit">
        <FormField label="Login" help="Please enter your login">
          <FormControl v-model="form.login" :icon="mdiAccount" name="login" />
        </FormField>

        <FormField label="Email" help="Please enter your email">
          <FormControl
            v-model="form.email"
            :icon="mdiAccount"
            name="email"
            type="email"
          />
        </FormField>

        <FormField label="Password" help="Please enter your password">
          <FormControl
            v-model="form.password"
            :icon="mdiAsterisk"
            type="password"
            name="password"
          />
        </FormField>

        <FormField label="Password" help="Please confirm your password">
          <FormControl
            v-model="form.confirmedPassword"
            :icon="mdiAsterisk"
            type="password"
            name="password"
          />
        </FormField>
        <template #footer>
          <Loader v-if="registrationStorage.isLoading" />
          <BaseButtons v-else>
            <BaseButton type="submit" color="info" label="Register" />
            <!--            <BaseButton to="/home" color="info" outline label="Back"/>-->
          </BaseButtons>
        </template>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>

<style scoped></style>
