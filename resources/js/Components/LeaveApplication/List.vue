<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import Details from '@/Components/LeaveApplication/Details.vue'
import { useForm } from '@inertiajs/vue3';
import { ref } from "vue";

const form = useForm({
    id : ''
});

const showModal = ref(false);
const LeaveDetails = ref([]);

const showDetails = async (leaveAppId) => {
  const url = `leave/${leaveAppId}`;
  const response = await fetch(url);
  LeaveDetails.value = await response.json();
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const deleteLeave = (leaveAppId) => {

  if (confirm("Are you sure?")) {
      const url = 'leave.destroy'
      form.id = leaveAppId
      form.delete(route(url,form), {
      preserveScroll: true,
    });
  }
  return ;
};
</script>

<template>
  <div>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
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
                      @click="showDetails(leave_app.id)"
                    >
                      View
                    </SecondaryButton>
                    <DangerButton @click="deleteLeave(leave_app.id)"> Delete </DangerButton>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Modal :show="showModal" @close="closeModal">
    <Details :leave_details="LeaveDetails"/>
    <div class="m-6 flex justify-end">
      <PrimaryButton v-if="$page.props.admin" class="mr-5"> Approve </PrimaryButton>
      <DangerButton v-if="$page.props.admin" class="mr-5"> Reject </DangerButton>
      <SecondaryButton @click="closeModal"> Close </SecondaryButton>
    </div>
  </Modal>
</template>