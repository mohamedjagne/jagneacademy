<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <figure class="relative cursor-pointer w-full h-36 sm:h-44 overflow-hidden rounded-lg shadow-md">
      <Link href="">
        <img class="w-full h-full hover:scale-110 transition-transform duration-300 ease-in-out" src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=872&q=80">
      </Link>
      <figcaption class="absolute px-4 text-lg text-white bottom-6">
          <p class="bg-teal-400 px-2 text-sm rounded-full">Programming</p>
      </figcaption>
    </figure>
</template>
