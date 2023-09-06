<script setup>
import Footer from "@/Components/Footer.vue";
import ListGroup from "@/Components/ListGroup.vue";
import Navbar from "@/Components/Navbar.vue";
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    student: Object,
});

const courses = computed(() => {
    if (props.student) {
        return props.student.course;
    } else {
        return [];
    }
});
</script>

<template>
    <Head title="Enrolled Courses" />
    <Navbar />
    <div
        class="md:flex max-w-6xl mx-auto my-8 space-y-4 md:space-y-0 md:space-x-4 px-4"
    >
        <ListGroup />
        <div class="w-full">
            <h1 class="text-xl">Enrolled Courses</h1>

            <div
                class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white mt-4"
            >
                <Link
                    v-for="course in courses"
                    :href="route('student.course.start', course.id)"
                    class="block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:text-teal-400 hover:bg-gray-200"
                >
                    <div class="flex items-center justify-between space-x-3">
                        <img
                            :src="'/storage/' + course.thumbnail"
                            class="w-11 h-8"
                        />
                        <p>{{ course.title }}</p>
                        <p>{{ course.pivot.status }}</p>
                    </div>
                </Link>
            </div>
        </div>
    </div>
    <Footer />
</template>
