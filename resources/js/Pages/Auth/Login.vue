<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <BreezeGuestLayout>
    <Head title="Login" />

    <BreezeValidationErrors class="tw-mb-4" />

    <div
      v-if="status"
      class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600"
    >
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <img src="/images/user.png" class="imagem tw-mx-auto" />
      <div>
        <BreezeLabel for="email" value="E-mail" />
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
        <BreezeLabel for="password" value="Senha" />
        <BreezeInput
          id="password"
          type="password"
          class="tw-mt-1 tw-block tw-w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
        />
      </div>

      <!--<div class="block mt-4">
        <label class="flex items-center">
          <BreezeCheckbox name="remember" v-model:checked="form.remember" />
          <span class="ml-2 text-sm text-gray-600">Lembre-se de mim</span>
        </label>
      </div>-->

      <div class="tw-text-center tw-mt-4">
        <BreezeButton
          :class="{ 'tw-opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Login
        </BreezeButton>
        <br />
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="
            tw-underline tw-text-sm tw-text-gray-600
            hover:tw-text-gray-900
          "
        >
          Esqueceu a senha?
        </Link>
      </div>
    </form>
  </BreezeGuestLayout>
</template>

<style>
.imagem {
  max-width: 50%;
}
</style>
