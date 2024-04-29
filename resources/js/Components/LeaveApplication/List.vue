<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
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
                  <th scope="col" class="px-6 py-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-neutral-200 dark:border-white/10" v-for="(leave_app, index) in ($page.props.leave_applications.data)" :key="index">
                  <td class="whitespace-nowrap px-6 py-4 font-medium">{{index+1}}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{leave_app.start_date}}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{leave_app.end_date}}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{leave_app.status}}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{leave_app.leave_type}}</td>
                  <td class="whitespace-nowrap px-6 py-4">
                    <SecondaryButton class="mr-2"> View </SecondaryButton>
                    <DangerButton> Delete </DangerButton>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>