<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.update"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <BreezeGuestLayout>
    <Head title="Reset Password" />

    <BreezeValidationErrors class="tw-mb-4" />

    <form @submit.prevent="submit">
      <div>
        <BreezeLabel for="email" value="Email" />
        <BreezeInput
          id="email"
          type="email"
          class="tw-mt-1 tw-block tw-w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />
      </div>

      <div class="tw-mt-4">
        <BreezeLabel for="password" value="Password" />
        <BreezeInput
          id="password"
          type="password"
          class="tw-mt-1 tw-block tw-w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="tw-mt-4">
        <BreezeLabel for="password_confirmation" value="Confirm Password" />
        <BreezeInput
          id="password_confirmation"
          type="password"
          class="tw-mt-1 tw-block tw-w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
        <BreezeButton
          :class="{ 'tw-opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Reset Password
        </BreezeButton>
      </div>
    </form>
  </BreezeGuestLayout>
</template>
