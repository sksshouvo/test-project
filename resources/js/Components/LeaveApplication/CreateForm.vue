<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SelectOption from "@/Components/SelectOption.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaBox from "@/Components/TextAreaBox.vue";
import { useForm } from "@inertiajs/vue3";
import moment from "moment";
import { ref } from "vue";

const leaveType = ref([
  { key: "casual", value: "Casual" },
  { key: "sick", value: "Sick" },
  { key: "emergency", value: "Emergency" },
]);

const form = useForm({
  start_date: null,
  end_date: null,
  leave_type: null,
  note: null,
});


const formatDate = (date) => {
  // Assuming you want YYYY-MM-DD format (adjust as needed)
  return moment(date).format("YYYY-MM-DD");
};

function submitForm() {
  const formattedStartDate = formatDate(form.start_date);
  const formattedEndDate = formatDate(form.end_date);

  form.post(
    route("leave.store"),
    {
      start_date: formattedStartDate,
      end_date: formattedEndDate,
      leave_type: form.leave_type,
      note: form.note,
    },
    {
      preserveScroll: true,
      onSuccess: () => form.reset(),
    }
  );
}
</script>
<template>
'  <div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
      Fill up form below to create leave
    </h2>

    <div class="mt-6">
      <label for="start_date">Start date</label>

      <TextInput
        id="start_date"
        ref="startDateInput"
        v-model="form.start_date"
        type="date"
        class="mt-1 block w-full"
        placeholder="Start Date"
      />

      <InputError :message="form.errors.start_date" class="mt-2" />
    </div>

    <div class="mt-6">
      <label for="end_date"> End Date </label>

      <TextInput
        id="end_date"
        ref="endDateInput"
        v-model="form.end_date"
        type="date"
        class="mt-1 block w-full"
        placeholder="End Date"
      />

      <InputError :message="form.errors.end_date" class="mt-2" />
    </div>
    <div class="mt-6">
      <label for="leave_type"> Leave Type: </label>

      <SelectOption
        name="leave_type"
        id="leave_type"
        :optionDatas="leaveType"
        class="mt-1 block w-full"
        v-model="form.leave_type"
      />

      <InputError :message="form.errors.leave_type" class="mt-2" />
    </div>
    <div class="mt-6">
      <label for="leave_type"> Note </label>
      <TextAreaBox
        name="note"
        id="note"
        placeholder="Note"
        class="mt-1 block w-full"
        v-model="form.note"
        ref="note"
      />
      <InputError :message="form.errors.note" class="mt-2" />
    </div>
    <div class="mt-6 flex justify-end">
      <PrimaryButton class="mr-5" @click="submitForm"> Submit </PrimaryButton>
    </div>
  </div>'
</template>