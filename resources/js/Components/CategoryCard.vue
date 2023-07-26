<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    img: String,
    caption: String,
});
</script>

<template>
    <figure
        class="relative cursor-pointer w-full h-48 sm:h-44 overflow-hidden rounded-lg shadow-md"
    >
        <Link href="">
            <img
                class="w-full h-full hover:scale-110 transition-transform duration-300 ease-in-out"
                :src="'/storage/' + img"
            />
        </Link>
        <figcaption class="absolute px-4 text-sm text-white bottom-6">
            <p class="bg-teal-400 px-2 rounded-full">{{ caption }}</p>
        </figcaption>
    </figure>
</template>
