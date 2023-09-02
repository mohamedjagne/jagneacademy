<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import "@vime/core/themes/default.css";
import { Player, DefaultUi, Video } from "@vime/vue-next";
import Footer from "@/Components/Footer.vue";
import { computed } from "vue";

const props = defineProps({
    course: Object,
    time: Number,
    totalLessons: Number,
});

const timeMin = Math.floor(props.time / 60);
const timeHr = Math.floor(props.time / 3600);

const totalTime = computed(() => {
    if (timeHr >= 1) {
        return `${timeHr} hrs`;
    } else {
        return `${timeMin} min`;
    }
});
</script>

<template>
    <Head :title="course.title" />

    <Navbar />

    <div class="w-full px-3 pb-11">
        <div
            class="bg-teal-500 p-5 mb-4 md:flex md:items-center md:space-x-3 rounded-md mt-4"
        >
            <div class="leading-relaxed md:w-1/2 space-y-3 text-white">
                <h1 class="text-3xl font-bold">{{ course.title }}</h1>
                <p>{{ course.description }}</p>
                <p>{{ totalLessons }} lessons {{ totalTime }}</p>
                <div class="flex items-center justify-between">
                    <Link :href="route('course.buy', course.id)">
                        <SecondaryButton>Start Course</SecondaryButton>
                    </Link>
                    <span
                        class="bg-white text-black font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                        >${{ course.price }}</span
                    >
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-4 md:mt-0">
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
        <div class="md:flex md:justify-between space-y-3 md:space-y-0">
            <div class="md:w-3/5 space-y-2">
                <h4 class="text-3xl">About the course</h4>
                <div v-html="course.body" class="leading-relaxed"></div>
            </div>

            <div class="md:space-y-2">
                <h4 class="text-2xl">What you will learn</h4>

                <ul
                    class="space-y-4 text-left text-gray-500 dark:text-gray-400 mt-4"
                >
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
                <h4 class="text-2xl mt-3">Share this course</h4>
                <div class="flex space-x-2">
                    <Link href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="30"
                            height="30"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(0, 0, 0, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path
                                d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z"
                            ></path>
                        </svg>
                    </Link>

                    <Link href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="30"
                            height="30"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(0, 0, 0, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263"
                            ></path>
                        </svg>
                    </Link>

                    <Link href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="30"
                            height="30"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(0, 0, 0, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path
                                d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"
                            ></path>
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
        <h4 class="text-2xl mt-3">Course content</h4>
        <div class="mt-4 bg-white rounded-md">
            <div v-for="section in course.section">
                <h4
                    v-if="section.lesson.length > 0"
                    class="py-2 px-4 text-gray-600"
                >
                    {{ section.title }}
                </h4>
                <Link
                    v-for="lesson in section.lesson"
                    :href="
                        route('courses.lessons.start', [course.id, lesson.id])
                    "
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium border-b border-gray-300 hover:text-teal-500 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white"
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
                        {{ lesson.title }}
                    </div>
                    <p>{{ lesson.duration }}</p>
                </Link>
            </div>
        </div>
    </div>
    <Footer />
</template>
