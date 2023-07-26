<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    thumbnail: String,
    title: String,
    description: String,
    price: Number,
});
</script>

<template>
    <Link
        href=""
        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
        <p href="#">
            <img
                class="rounded-t-lg w-full h-52 object-cover"
                :src="'/storage/' + thumbnail"
                :alt="title"
            />
        </p>
        <div class="p-5">
            <p href="#">
                <h5
                    class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white"
                >
                    {{ title }}
                </h5>
            </p>
            <p class="flex items-center text-sm">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span>17hrs | 157lessons</span>
            </p>
            <p
                class="my-3 text-sm font-normal text-gray-700 dark:text-gray-400"
            >
                {{ description }}
            </p>
            <div class="flex items-center justify-between">
                <!-- <PrimaryButton class="flex items-center">
                    Enroll
                    <svg
                        aria-hidden="true"
                        class="w-4 h-4 ml-2 -mr-1"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </PrimaryButton> -->
                <span
                    class="bg-teal-300 text-teal-800 font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-teal-900 dark:text-teal-300 text-sm"
                    >Premium</span
                >
                <span
                    class="bg-red-200 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 text-sm"
                    >${{ price }}</span
                >
            </div>
        </div>
    </Link>
</template>
