<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { mdiAccount, mdiAsterisk } from "@mdi/js";
import SectionFullScreen from "@/components/Elements/SectionFullScreen.vue";
import CardBox from "@/components/Elements/CardBox/CardBox.vue";
import FormCheckRadio from "@/components/Elements/Form/FormCheckRadio.vue";
import FormField from "@/components/Elements/Form/FormField.vue";
import FormControl from "@/components/Elements/Form/FormControl.vue";
import BaseButton from "@/components/Elements/BaseButton.vue";
import BaseButtons from "@/components/Elements/BaseButtons.vue";
import LayoutGuest from "@/layouts/LayoutGuest.vue";
import { useAuthorizationStore } from "@/stores/authorization/authorization";
import Loader from "@/components/Elements/Loader.vue";
import { toast } from "vue3-toastify";

const form = reactive({
  email: "ayaka@tim.com",
  password: "password",
  remember: true,
});

const router = useRouter();
const authorizationStorage = useAuthorizationStore();
const submit = async () => {
  authorizationStorage.doLogin(form).then(() => {
    if (authorizationStorage.isError) {
      toast.error(authorizationStorage.error);
      return;
    }
    if (authorizationStorage.isLogin) router.push("/profile");
  });
};
</script>

<template>
  <LayoutGuest>
    <SectionFullScreen v-slot="{ cardClass }" bg="purplePink">
      <CardBox :class="cardClass" is-form @submit.prevent="submit">
        <FormField label="Email" help="Please enter your email">
          <FormControl
            v-model="form.email"
            :icon="mdiAccount"
            name="email"
            autocomplete="username"
          />
        </FormField>

        <FormField label="Password" help="Please enter your password">
          <FormControl
            v-model="form.password"
            :icon="mdiAsterisk"
            type="password"
            name="password"
            autocomplete="current-password"
          />
        </FormField>

        <FormCheckRadio
          v-model="form.remember"
          name="remember"
          label="Remember"
          :input-value="true"
        />

        <template #footer>
          <Loader v-if="authorizationStorage.isLoading" />
          <BaseButtons v-else>
            <BaseButton type="submit" color="info" label="Login" />
            <!--            <BaseButton to="/home" color="info" outline label="Back" />-->
          </BaseButtons>
        </template>
        <p>
          Don't have an account?
          <router-link to="/registration">Register</router-link>
        </p>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
