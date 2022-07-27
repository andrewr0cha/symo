<script setup>
defineProps(["value"]);
</script>

<template>
  <label class="label">
    <span v-if="value">{{ value }}</span>
    <span v-else>
      <slot />
    </span>
  </label>
</template>

<style scoped>
.label {
  border: 2px solid black;
  border-radius: 25px;
  padding-top: 10px;
  display: inline-block;
  width: 100%;
}

.label:hover {
  background-color: #1ed760;
}
</style>