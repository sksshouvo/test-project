<script setup>
const props = defineProps({
    leave_details: Array
});

</script>

<template>
    <div class="rounded-lg border-4 border-gray-200 p-5">
        <div class="w-full">
            <h3 class="text-lg font-medium pb-3 border-b-4 border-gray-300">Leave Application Details below</h3>
        </div>
        <div class="w-full mt-5">
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2"> <span class="font-medium">Leave Applied</span> By: {{props.leave_details.creator.name}}</p>
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2"> <span class="font-medium">Start dat</span>e: {{props.leave_details?.start_date}}</p>
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2"> <span class="font-medium">End dat</span>e: {{props.leave_details?.end_date}}</p>
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2"> <span class="font-medium">Leave Typ</span>e: {{props.leave_details?.leave_type}}</p>
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2"> <span class="font-medium">Status:</span> {{props.leave_details?.status}}</p>
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2 pb-10"> <span class="font-medium">Reason:</span> {{props.leave_details?.reason}}</p>
            <p class="mb-2 rounded-lg border-2 border-gray-200 px-2 pb-10"> <span class="font-medium">Comment:</span> {{props.leave_details?.Comment}}</p>
        </div>
    </div>
</template>