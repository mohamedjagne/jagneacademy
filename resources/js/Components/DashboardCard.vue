<script setup>
defineProps({
    count: Number,
    title: String,
});
</script>

<template>
    <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:hover:bg-gray-700"
    >
        <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
            {{ count }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ title }}</p>
    </div>
</template>
