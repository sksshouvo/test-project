<script setup>
import AuthenticatedAdminLayout from "@/Layouts/AuthenticatedAdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedAdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex text-white font-bold"
        >
          <div
            class="rounded-md shadow-md h-40 w-1/2 m-10 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 flex-initial"
          >
            <Link href="/admin/leaves" :class="classes">
                <p class="p-5">Leave Applications</p>  
                <p class="px-5">Total Leave Requets: {{$page.props.total_leaves}}</p>  
                <p class="px-5">Total Pending Requets: {{$page.props.total_pending_leaves}}</p>  
                <p class="px-5">Total Approved Requets: {{$page.props.total_approved_leaves}}</p>  
            </Link>
          </div>
          <div
            class="rounded-md shadow-md h-40 w-1/2 m-10 bg-gradient-to-r from-cyan-500 to-blue-500 flex-initial"
          >
            <p class="p-5">Manage Users</p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedAdminLayout>
</template>
