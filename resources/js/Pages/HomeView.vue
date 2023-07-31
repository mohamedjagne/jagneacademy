<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";
import Hero from "@/Components/Hero.vue";
import Card from "@/Components/Card.vue";
import CategoryCard from "@/Components/CategoryCard.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    categories: Array,
    courses: Array,
});
</script>

<template>
    <Head title="Institute of programming and design" />
    <Navbar />
    <Hero />
    <div class="max-w-6xl mx-auto my-11 p-4">
        <h1>Latest Courses</h1>
        <div
            class="mt-3 grid grid-rows-1 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2"
        >
            <Card
                v-for="course in courses"
                :thumbnail="course.thumbnail"
                :title="course.title"
                :description="course.description"
                :price="course.price"
                :id="course.id"
            />
        </div>
    </div>
    <div class="max-w-6xl mx-auto mb-11 p-4">
        <h1>Categories</h1>
        <div
            class="mt-3 grid grid-rows-1 grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2"
        >
            <CategoryCard
                v-for="category in categories"
                :img="category.image"
                :caption="category.category_name"
            />
        </div>
    </div>
    <div>
        <Footer />
    </div>
</template>
