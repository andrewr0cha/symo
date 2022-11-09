<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
  props.active
    ? "tw-block tw-pl-3 tw-pr-4 tw-py-2 tw-border-l-4 tw-border-cyan-600 tw-text-base tw-font-medium tw-text-cyan-700 tw-bg-cyan-50 focus:tw-outline-none focus:tw-text-cyan-800 focus:tw-bg-cyan-500 focus:tw-border-cyan-900 tw-transition tw-duration-150 tw-ease-in-out"
    : "tw-block tw-pl-3 tw-pr-4 tw-py-2 tw-border-l-4 tw-border-transparent tw-text-base tw-font-medium tw-text-gray-600 hover:tw-text-gray-800 hover:tw-bg-cyan-200 hover:tw-border-cyan-500 focus:tw-outline-none focus:tw-text-gray-800 focus:tw-bg-cyan-500 focus:tw-border-cyan-900 tw-transition tw-duration-150 tw-ease-in-out"
);
</script>

<template>
  <Link :href="href" :class="classes">
  <slot />
  </Link>
</template>
