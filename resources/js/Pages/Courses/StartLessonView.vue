<script setup>
import Footer from "@/Components/Footer.vue";
import Navbar from "@/Components/Navbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link } from "@inertiajs/vue3";
import "@vime/core/themes/default.css";
import { Player, DefaultUi, Video } from "@vime/vue-next";
import { computed } from "vue";

const props = defineProps({
    lesson: Object,
    course: Object,
});

const hasCourse = computed(() => {
    if (props.course.student.length > 0) {
        if (
            props.course.student[0] !== null &&
            props.course.student[0].pivot.status === "Active"
        ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
});
</script>

<template>
    <Head :title="lesson.title" />

    <Navbar />

    <div class="max-w-6xl mx-auto px-5 my-8">
        <div
            v-if="!hasCourse"
            class="bg-gray-300 w-full py-16 rounded-md flex flex-col space-y-1 items-center justify-center"
        >
            <h1 class="text-gray-500 text-lg">Unlock the course</h1>
            <Link :href="route('course.buy', course.id)">
                <PrimaryButton>Start Course</PrimaryButton>
            </Link>
        </div>
        <div v-if="hasCourse">
            <Player>
                <!-- Provider component is placed here. -->
                <Video crossorigin="">
                    <source
                        :data-src="'/storage/' + lesson.video"
                        type="video/mp4"
                    />
                </Video>
                <DefaultUi noClickToPlay>
                    <!-- We can place our own UI components here to extend the default UI. -->
                </DefaultUi>
            </Player>
            <!-- <video :src="previewUrl" class="w-full h-full" controls></video> -->
        </div>
        <div
            v-html="lesson.body"
            class="leading-relaxed mt-4"
            :class="{
                'blur-sm select-none': !hasCourse,
            }"
        ></div>

        <div class="mt-4 bg-white rounded-md">
            <div v-for="section in course.section">
                <h4
                    v-if="section.lesson.length > 0"
                    class="py-2 px-4 text-gray-600"
                >
                    {{ section.title }}
                </h4>
                <Link
                    v-for="theLesson in section.lesson"
                    :href="
                        route('courses.lessons.start', [
                            course.id,
                            theLesson.id,
                        ])
                    "
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium border-b border-gray-300 hover:text-teal-500 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white"
                    :class="{ 'text-teal-500': lesson.id === theLesson.id }"
                >
                    <div class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 mr-1 text-teal-400"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z"
                            />
                        </svg>
                        {{ theLesson.title }}
                    </div>
                    <p>{{ theLesson.duration }}</p>
                </Link>
            </div>
        </div>
    </div>

    <Footer />
</template>
