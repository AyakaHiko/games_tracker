<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import LayoutGuest from '@/layouts/LayoutGuest.vue'
import SectionFullScreen from '@/components/Elements/SectionFullScreen.vue'
import CardBox from '@/components/Elements/CardBox/CardBox.vue'
import FormControl from '@/components/Elements/Form/FormControl.vue'
import FormField from '@/components/Elements/Form/FormField.vue'
import BaseDivider from '@/components/Elements/BaseDivider.vue'
import BaseButton from '@/components/Elements/BaseButton.vue'
import FormValidationErrors from '@/components/FormValidationErrors.vue'

const form = useForm({
  password: ''
})

const passwordInput = ref(null)

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => {
      form.reset()

      passwordInput.value?.focus()
    }
  })
}
</script>

<template>
  <LayoutGuest>
    <Head title="Secure Area" />

    <SectionFullScreen
      v-slot="{ cardClass }"
      bg="purplePink"
    >
      <CardBox
        :class="cardClass"
        is-form
        @submit.prevent="submit"
      >
        <FormValidationErrors />

        <FormField>
          <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
          </div>
        </FormField>

        <FormField
          label="Password"
          label-for="password"
          help="Please enter your password to confirm"
        >
          <FormControl
            id="password"
            @set-ref="passwordInput = $event"
            v-model="form.password"
            type="password"
            required
            autocomplete="current-password"
          />
        </FormField>

        <BaseDivider />

        <BaseButton
          type="submit"
          color="info"
          label="Confirm"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        />
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
