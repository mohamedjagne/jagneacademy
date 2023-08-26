<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import "@vime/core/themes/default.css";
import { Player, DefaultUi, Video } from "@vime/vue-next";
import { ref } from "vue";

const props = defineProps({
    sections: Array,
    errors: Object,
    course: Object,
    lesson: Object,
});

const form = useForm({
    title: props.lesson.title,
    body: props.lesson.body,
    video: props.lesson.video,
    section_id: props.lesson.section_id,
});

const submit = () => {
    router.post(
        route("courses.lessons.update", [props.course.id, props.lesson.id]),
        {
            _method: "put",
            title: form.title,
            body: form.body,
            video: form.video,
            section_id: form.section_id,
        }
    );
};

const videoUrl = ref("/storage/" + form.video);

const videoChanged = () => {
    videoUrl.value = URL.createObjectURL(form.video);
};

const removeVideo = () => {
    form.video = "";
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Update Lesson" />
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="Title" />
                <TextInput
                    id="title"
                    type="text"
                    v-model="form.title"
                    placeholder="title"
                    class="mt-2 w-full"
                />
                <InputError :message="errors.title" />
            </div>
            <div class="mt-8">
                <InputLabel value="Body" />
                <div class="mt-2">
                    <QuillEditor
                        theme="snow"
                        toolbar="full"
                        v-model:content="form.body"
                        contentType="html"
                    />
                </div>
                <InputError :message="errors.body" />
            </div>
            <div class="mt-4">
                <InputLabel value="Video" />
                <div class="bg-grey-lighter mt-2">
                    <label
                        v-if="!form.video"
                        class="w-72 h-44 flex flex-col items-center justify-center bg-white text-teal-400 rounded-lg shadow-sm tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-teal-500"
                    >
                        <svg
                            class="w-8 h-8"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                            />
                        </svg>
                        <span class="mt-2 text-base leading-normal"
                            >Select a video</span
                        >
                        <TextInput
                            type="file"
                            class="hidden"
                            @input="form.video = $event.target.files[0]"
                            @change="videoChanged"
                        />
                    </label>
                    <InputError :message="errors.video" />
                    <div v-if="form.video" class="w-72 h-44">
                        <Player>
                            <!-- Provider component is placed here. -->
                            <Video crossorigin="">
                                <source :data-src="videoUrl" type="video/mp4" />
                            </Video>
                            <DefaultUi noClickToPlay>
                                <!-- We can place our own UI components here to extend the default UI. -->
                            </DefaultUi>
                        </Player>
                        <!-- <video :src="previewUrl" class="w-full h-full" controls></video> -->
                        <div
                            @click="removeVideo"
                            class="flex items-center justify-center text-red-600 bg-gray-200 p-1 cursor-pointer"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <InputLabel value="Category" />
                <select
                    v-model="form.section_id"
                    class="mt-2 border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm w-full"
                >
                    <option value="">Select Section</option>
                    <option v-for="section in sections" :value="section.id">
                        {{ section.title }}
                    </option>
                </select>
                <InputError :message="errors.section_id" />
            </div>
            <PrimaryButton class="mt-4"> Update Lesson </PrimaryButton>
        </form>
    </AuthenticatedLayout>
</template>
