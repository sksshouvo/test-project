<script setup>
defineProps({
  optionDatas: {
    type: Array,
  },
});

const model = defineModel({
    type: String,
    required: true,
});

</script>

<template>
  <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="model">
    <option value="" selected>-Select One-</option>
    <option v-for="(data, index) in optionDatas" :key="index" :value="data.key">  {{ data.value }}  </option>
  </select>
</template>