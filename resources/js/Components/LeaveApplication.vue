<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CreateLeaveForm from "@/Components/LeaveApplication/CreateForm.vue";
import List from "@/Components/LeaveApplication/List.vue";
import { ref } from "vue";

const CreateForm = ref(false);

const toggleForm = () => {
  CreateForm.value = !CreateForm.value;
};

</script>

<template>
  <div
    class="flex justify-between rounded-lg bg-white p-6 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white"
  >
    <div class="flex-initial">
      <h5 class="mb-2 text-xl font-medium leading-tight">Leave Applications</h5>
    </div>

    <div class="flex-initial pl-5">
      <PrimaryButton @click="toggleForm"> {{ CreateForm ? 'Back' : 'Create leave' }} </PrimaryButton>
    </div>
  </div>

  <CreateLeaveForm v-if='CreateForm' />
  <List v-else/>


</template>