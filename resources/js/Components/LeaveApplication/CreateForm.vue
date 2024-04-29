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
  reason: null,
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
      reason: form.reason,
    },
    {
      preserveScroll: true,
      onFinal: () => form.reset(),
    }
  );
}
</script>
<template>
  '
  <div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
      Fill up form below to create leave
    </h2>
    <div
      class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mt-2"
      role="alert"
      v-if="$page.props.form_submit"
    >
      <div class="flex">
        <div class="py-1">
          <svg
            class="fill-current h-6 w-6 text-teal-500 mr-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
            />
          </svg>
        </div>
        <div>
          <p class="font-bold">Form Submitted Successfully</p>
        </div>
      </div>
    </div>
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
      <label for="leave_type"> Reason </label>
      <TextAreaBox
        name="reason"
        id="reason"
        placeholder="Reason"
        class="mt-1 block w-full"
        v-model="form.reason"
        ref="reason"
      />
      <InputError :message="form.errors.reason" class="mt-2" />
    </div>
    <div class="mt-6 flex justify-end">
      <PrimaryButton class="mr-5" @click="submitForm"> Submit </PrimaryButton>
    </div>
  </div>
  '
</template>