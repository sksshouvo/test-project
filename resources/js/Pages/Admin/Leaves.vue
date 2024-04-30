<script setup>
import AuthenticatedAdminLayout from "@/Layouts/AuthenticatedAdminLayout.vue";
import List from "@/Components/LeaveApplication/List.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Leaves" />

  <AuthenticatedAdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List of Leave Applications
      </h2>
    </template>
    
    <div class="w-2/3 bg-white mx-auto mt-20">
        <List class="w-full"/>
    </div>
    
  </AuthenticatedAdminLayout>
</template>
