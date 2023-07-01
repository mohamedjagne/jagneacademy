<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="flex flex-col md:flex-row h-screen items-center">

      <div class="hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
        <img src="/images/guest-image.jpg" alt="" class="w-full h-full object-cover">
      </div>
        <slot />
    </section>
</template>
