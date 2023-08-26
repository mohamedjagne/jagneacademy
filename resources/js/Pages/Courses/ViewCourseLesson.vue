<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import "@vime/core/themes/default.css";
import { Player, DefaultUi, Video } from "@vime/vue-next";

defineProps({
    lesson: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="lesson.title" />
        <div>
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
        <div v-html="lesson.body" class="leading-relaxed mt-4"></div>
    </AuthenticatedLayout>
</template>
