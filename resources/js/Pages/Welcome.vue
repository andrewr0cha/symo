<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>

  <Head title="Entrar" />
  <!--dark:tw-bg-gray-900-->
  <div class="
      tw-relative
      tw-flex
      tw-items-top
      tw-justify-center
      tw-min-h-screen
      tw-bg-gray-100
      tw-items-center tw-pt-0
    ">
    <div v-if="canLogin" class="tw-mx-auto tw-top-0 tw-right-0 tw-px-6 tw-py-4">
      <div v-if="$page.props.auth.user" class="tw-flex tw-flex-col tw-items-center">
        <div class="tw-mb-2"><img src="/images/logo-desenho.png" style="max-width: 250px;" /></div>
        <div class="tw-mb-2"><img src="/images/user.png" class="image" /></div>
        <div class="tw-mb-2 tw-text-lg">Seja bem-vindo, {{ $page.props.auth.user.name }}</div>
        <Link :href="route('dashboard')" class="tw-mb-2"><span class="material-icons md-48">login</span>
        </Link>
        <Link :href="route('dashboard')" class="tw-mb-2 tw-underline">Trocar de Conta
        </Link>
      </div>
      <div v-else class="tw-flex tw-flex-col tw-items-center">
        <div class="tw-mb-2"><img src="/images/logo-desenho.png" style="max-width: 250px;" /></div>
        <div class="tw-mb-2"><img src="/images/user.png" class="image" /></div>
        <div class="tw-mb-2 tw-text-lg">Já tem uma conta?
          <Link :href="route('login')" class="tw-text-gray-700 tw-underline">Entrar
          </Link>
        </div>
        <div class="tw-mb-2 tw-text-lg">Não tem uma conta?
          <Link v-if="canRegister" :href="route('register')" class="tw-text-gray-700 tw-underline">
          Vamos criar uma!
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.image {
  max-width: 200px;
}

.bg-gray-100 {
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
  border-color: #edf2f7;
  border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
  color: #cbd5e0;
  color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
  color: #a0aec0;
  color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
  color: #718096;
  color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
  color: #4a5568;
  color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
  color: #1a202c;
  color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #2d3748;
    background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
  }

  .dark\:bg-gray-900 {
    background-color: #1a202c;
    background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
  }

  .dark\:border-gray-700 {
    border-color: #4a5568;
    border-color: rgba(74, 85, 104, var(--tw-border-opacity));
  }

  .dark\:text-white {
    color: #fff;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
  }

  .dark\:text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
  }
}
</style>
