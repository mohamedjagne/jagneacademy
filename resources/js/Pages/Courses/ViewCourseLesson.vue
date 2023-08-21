<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Tabs from "@/Components/Tabs.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
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
