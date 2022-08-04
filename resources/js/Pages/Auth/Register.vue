<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
  name: "",
  email: "",
  usuario: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>


<template>
  <BreezeGuestLayout>

    <Head title="Cadastro" />

    <form @submit.prevent="submit" class="tw-w-max-10/12">
      <div class="sm:tw-flex sm:tw-flex-inline sm:tw-justify-center tw-items-center">
        <h1 class="tw-text-center tw-text-xl sm:tw-text-2xl tw-font-bold">Crie sua conta</h1>
        <img src="/images/logo.png" class="image tw-mx-auto sm:tw-mx-1" />
      </div>
      <BreezeValidationErrors class="tw-mb-4" />
      <div class="tw-mt-2">
        <BreezeLabel for="name" value="Nome*" />
        <BreezeInput id="name" type="text" class="tw-mt-1 tw-block tw-w-full" v-model="form.name" required autofocus
          autocomplete="name" />
      </div>

      <div class="tw-mt-4">
        <BreezeLabel for="email" value="E-mail*" />
        <BreezeInput id="email" type="email" class="tw-mt-1 tw-block tw-w-full" v-model="form.email" required
          autocomplete="username" />
      </div>

      <div class="tw-mt-4">
        <BreezeLabel for="usuario" value="Usuário*" />
        <BreezeInput id="usuario" type="text" class="tw-mt-1 tw-block tw-w-full" v-model="form.usuario" required
          autocomplete="usuario" />
      </div>

      <div class="tw-mt-4">
        <BreezeLabel for="password" value="Senha*" />
        <BreezeInput id="password" type="password" class="tw-mt-1 tw-block tw-w-full" v-model="form.password" required
          autocomplete="new-password" />
      </div>

      <div class="tw-mt-4">
        <BreezeLabel for="password_confirmation" value="Confirmar senha*" />
        <BreezeInput id="password_confirmation" type="password" class="tw-mt-1 tw-block tw-w-full"
          v-model="form.password_confirmation" required autocomplete="new-password" />
      </div>

      <div class="tw-text-center tw-mt-4">
        <BreezeButton :class="{ 'tw-opacity-25': form.processing }" :disabled="form.processing">
          <span class="material-icons">check_circle_outline</span>
        </BreezeButton>
      </div>
      <div class="tw-text-center tw-mt-2">
        <Link :href="route('login')" class="
            tw-underline tw-text-sm tw-text-gray-600
            hover:tw-text-gray-900
          ">
        Já tem uma conta?
        </Link>
      </div>
    </form>
  </BreezeGuestLayout>
</template>

<style scoped>
.image {
  max-width: 40%;
  min-width: 10%;
}
</style>


