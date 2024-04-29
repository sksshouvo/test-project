<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <h1 class="text-5xl font-bold text-center">Lead Academy Test</h1>
                <div v-if="canLogin" class="w-full text-center mt-10">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2"
                            >
                                Register
                            </Link>
                            <Link
                                :href="route('admin.login')"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2"
                            >
                                Admin Log in
                            </Link>
                        </template>
                    </div>
            </div>
        </div>
    </div>
</template>
