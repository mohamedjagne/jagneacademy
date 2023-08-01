<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="bg-gray-200 h-screen flex items-center justify-center">
        <section
            class="flex flex-col md:flex-row items-center max-w-5xl mx-auto w-full h-4/5 rounded-md overflow-hidden mx-4"
        >
            <div class="hidden lg:block w-full h-full md:w-1/2 xl:w-2/3">
                <img
                    src="/images/guest-image.jpg"
                    alt=""
                    class="w-full h-full object-cover"
                />
            </div>
            <slot />
        </section>
    </div>
</template>
