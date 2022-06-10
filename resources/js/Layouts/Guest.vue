<script setup>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
  <div
    class="
      tw-min-h-screen tw-flex
      sm:tw-justify-center
      tw-items-left tw-p-6
      sm:tw-pt-0
      tw-bg-gray-900
    "
  >
    <!--<div class="m-auto">
      <Link href="/">
        <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
      </Link>
    </div>-->

    <div
      class="
        sm:tw-max-w-md
        tw-rounded
        tw-m-auto
        tw-px-6
        tw-py-4
        tw-bg-white
        tw-shadow-md
        tw-overflow-hidden
        sm:tw-rounded-lg
        tw-items-center tw-justify-center
      "
    >
      <slot />
    </div>
    <div
      class="
        tw-hidden
        sm:tw-inline-flex sm:max-w-md
        tw-m-auto tw-px-6 tw-py-4 tw-bg-white tw-shadow-md tw-overflow-hidden
        sm:tw-rounded-lg
      "
    >
      <img src="images/ive.jpg" />
    </div>
  </div>
</template>
