<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import Details from "@/Components/LeaveApplication/Details.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
  id: "",
  comment: "",
});

const isShowModal = ref(false);
const LeaveDetails = ref([]);

const showDetails = (leaveApp) => {
  LeaveDetails.value = leaveApp;
  isShowModal.value = true;
};

const closeModal = () => {
  isShowModal.value = false;
};

const deleteLeave = (leaveAppId) => {
  if (confirm("Are you sure?")) {
    const url = "leave.destroy";
    form.id = leaveAppId;
    form.delete(route(url, form), {
      preserveScroll: true,
    });
  }
  return;
};

const updateLeave = (leaveAppId, status) => {
  const url = "admin.leave.update";
  form.id = leaveAppId;
  form.status = status;

  form.put(route(url, form), {
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
      form.reset();
    },
  });
};
</script>

<template>
  <div>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <!-- <div
            class="bg-red-100 border-t-4 border-red-500 rounded-b text-teal-900 px-4 py-3 shadow-md mt-2"
            role="alert"
            v-if="$page.props.errors && $page.props.admin"
          >
            <div class="flex">
              <div class="py-1"></div>
              <div>
                <p class="font-bold">{{ $page.props.errors }}</p>
              </div>
            </div>
          </div> -->
          <div class="overflow-hidden">
            <table
              class="min-w-full text-left text-sm font-light text-surface dark:text-white"
            >
              <thead
                class="border-b border-neutral-200 font-medium dark:border-white/10"
              >
                <tr>
                  <th scope="col" class="px-6 py-4">SL</th>
                  <th scope="col" class="px-6 py-4">Start Date</th>
                  <th scope="col" class="px-6 py-4">End date</th>
                  <th scope="col" class="px-6 py-4">Status</th>
                  <th scope="col" class="px-6 py-4">Leave Type</th>
                  <th scope="col" class="px-6 py-4">Created At</th>
                  <th scope="col" class="px-6 py-4">Creator</th>
                  <th scope="col" class="px-6 py-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="border-b border-neutral-200 dark:border-white/10"
                  v-for="(leave_app, index) in $page.props.leave_applications"
                  :key="index"
                >
                  <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{ index + 1 }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ leave_app.start_date }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ leave_app.end_date }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ leave_app.status }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ leave_app.leave_type }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ leave_app.created_at }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    {{ leave_app.creator.name }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">
                    <SecondaryButton
                      class="mr-2"
                      @click="showDetails(leave_app)"
                    >
                      View
                    </SecondaryButton>
                    <DangerButton
                      v-if="!$page.props.admin"
                      @click="deleteLeave(leave_app.id)"
                    >
                      Delete
                    </DangerButton>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Modal :show="isShowModal" @close="closeModal">
    <Details :leave_details="LeaveDetails" v-model="form.comment" />
    <div class="m-6 flex justify-end">
      <PrimaryButton
        v-if="$page.props.admin && LeaveDetails.status == 'PENDING'"
        @click="updateLeave(LeaveDetails.id, 'approved')"
        class="mr-5"
      >
        Approve
      </PrimaryButton>
      <DangerButton
        v-if="$page.props.admin && LeaveDetails.status == 'PENDING'"
        @click="updateLeave(LeaveDetails.id, 'rejected')"
        class="mr-5"
      >
        Reject
      </DangerButton>
      <SecondaryButton @click="closeModal"> Close </SecondaryButton>
    </div>
  </Modal>
</template>