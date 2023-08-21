<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Tabs from "@/Components/Tabs.vue";
import { ref } from "vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import "@vime/core/themes/default.css";
import { Player, DefaultUi, Video } from "@vime/vue-next";

defineProps({
    course: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="course.title" />

        <Tabs :id="course.id" />

        <div
            class="w-full bg-teal-500 p-5 mb-4 md:flex md:space-x-3 rounded-md mt-4"
        >
            <div class="leading-relaxed md:w-1/2 space-y-3 text-white">
                <h1 class="text-3xl font-bold">{{ course.title }}</h1>
                <p>{{ course.description }}</p>
                <p>14 lessons 1 hr</p>
                <h4>${{ course.price }}</h4>
            </div>
            <div class="md:w-1/2 md:mt-0 mt-4">
                <Player>
                    <!-- Provider component is placed here. -->
                    <Video crossorigin="">
                        <source
                            :data-src="'/storage/' + course.preview"
                            type="video/mp4"
                        />
                    </Video>
                    <DefaultUi noClickToPlay>
                        <!-- We can place our own UI components here to extend the default UI. -->
                    </DefaultUi>
                </Player>
                <!-- <video :src="previewUrl" class="w-full h-full" controls></video> -->
            </div>
        </div>
        <div v-html="course.body" class="leading-relaxed"></div>

        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400 mt-4">
            <li
                v-for="ob in course.objectives.split(',')"
                class="flex items-center space-x-3"
            >
                <svg
                    class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 16 12"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M1 5.917 5.724 10.5 15 1.5"
                    />
                </svg>
                <span>{{ ob }}</span>
            </li>
        </ul>
    </AuthenticatedLayout>
</template>
