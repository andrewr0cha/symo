<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
  props.active
    ? "tw-block tw-pl-3 tw-pr-4 tw-py-2 tw-border-l-4 tw-border-emerald-600 tw-text-base tw-font-medium tw-text-emerald-700 tw-bg-emerald-50 focus:tw-outline-none focus:tw-text-emerald-800 focus:tw-bg-emerald-500 focus:tw-border-emerald-900 tw-transition tw-duration-150 tw-ease-in-out"
    : "tw-block tw-pl-3 tw-pr-4 tw-py-2 tw-border-l-4 tw-border-transparent tw-text-base tw-font-medium tw-text-gray-600 hover:tw-text-gray-800 hover:tw-bg-emerald-200 hover:tw-border-emerald-500 focus:tw-outline-none focus:tw-text-gray-800 focus:tw-bg-emerald-500 focus:tw-border-emerald-900 tw-transition tw-duration-150 tw-ease-in-out"
);
</script>

<template>
  <Link :href="href" :class="classes">
  <slot />
  </Link>
</template>
