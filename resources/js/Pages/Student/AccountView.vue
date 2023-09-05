<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import { Link, Head } from "@inertiajs/vue3";
import ListGroup from "@/Components/ListGroup.vue";

defineProps({
    activeCourses: Number,
    enrolledCourses: Number,
});
</script>

<template>
    <Head title="Student Account" />
    <Navbar />

    <div
        class="md:flex max-w-6xl mx-auto my-8 space-y-4 md:space-y-0 md:space-x-4 px-4"
    >
        <ListGroup />
        <div
            class="md:flex md:space-x-3 space-x-0 space-y-2 md:space-y-0 w-full h-fit"
        >
            <div
                class="md:max-w-sm w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center"
            >
                <div class="flex items-center justify-center">
                    <svg
                        class="w-11 h-11 text-teal-400 bg-teal-100 p-2 rounded-full"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                        />
                    </svg>
                </div>

                <h5
                    class="my-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
                >
                    {{ enrolledCourses.course_count }}
                </h5>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Enrolled Courses
                </p>
            </div>
            <div
                class="md:max-w-sm w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center"
            >
                <div class="flex items-center justify-center">
                    <svg
                        class="w-11 h-11 text-teal-400 bg-teal-100 p-2 rounded-full"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                        />
                    </svg>
                </div>

                <h5
                    class="my-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
                >
                    {{ activeCourses.course_count }}
                </h5>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Active Courses
                </p>
            </div>
            <div
                class="md:max-w-sm w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center"
            >
                <div class="flex items-center justify-center">
                    <svg
                        class="w-11 h-11 text-teal-400 bg-teal-100 p-2 rounded-full"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                        />
                    </svg>
                </div>

                <h5
                    class="my-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
                >
                    0
                </h5>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Completed Courses
                </p>
            </div>
        </div>
    </div>
    <Footer />
</template>
