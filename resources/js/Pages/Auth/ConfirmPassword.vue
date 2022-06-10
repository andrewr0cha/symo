<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
  password: "",
});

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <BreezeGuestLayout>
    <Head title="Confirm Password" />

    <div class="tw-mb-4 tw-text-sm tw-text-gray-600">
      This is a secure area of the application. Please confirm your password
      before continuing.
    </div>

    <BreezeValidationErrors class="tw-mb-4" />

    <form @submit.prevent="submit">
      <div>
        <BreezeLabel for="password" value="Password" />
        <BreezeInput
          id="password"
          type="password"
          class="tw-mt-1 tw-block tw-w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
          autofocus
        />
      </div>

      <div class="tw-flex tw-justify-end tw-mt-4">
        <BreezeButton
          class="tw-ml-4"
          :class="{ 'tw-opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Confirm
        </BreezeButton>
      </div>
    </form>
  </BreezeGuestLayout>
</template>
