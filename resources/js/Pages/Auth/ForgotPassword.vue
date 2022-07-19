<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <BreezeGuestLayout>

    <Head title="Recuperar Senha" />

    <div class="tw-mb-4 tw-text-sm tw-text-gray-600">
      Esqueceu sua senha? Sem problemas. Apenas nos deixe saber seu endereço de
      email e nós enviaremos a você um link que permitirá a você escolher uma nova senha.
    </div>

    <div v-if="status" class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600">
      {{ status }}
    </div>

    <BreezeValidationErrors class="tw-mb-4" />

    <form @submit.prevent="submit">
      <div>
        <BreezeLabel for="email" value="Email" />
        <BreezeInput id="email" type="email" class="tw-mt-1 tw-block tw-w-full" v-model="form.email" required autofocus
          autocomplete="username" />
      </div>

      <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
        <BreezeButton :class="{ 'tw-opacity-25': form.processing }" :disabled="form.processing">
          Confirmar
        </BreezeButton>
      </div>
    </form>
  </BreezeGuestLayout>
</template>
