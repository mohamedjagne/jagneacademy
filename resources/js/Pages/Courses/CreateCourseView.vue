<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import InputLabel from '@/Components/InputLabel.vue'
    import TextInput from '@/Components/TextInput.vue'
    import { Head, Link, useForm } from '@inertiajs/vue3'
    import { ref } from 'vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { QuillEditor } from '@vueup/vue-quill'
    import '@vueup/vue-quill/dist/vue-quill.snow.css'
    import '@vime/core/themes/default.css';
    import { Player, DefaultUi, Video } from '@vime/vue-next';

    const thumbnailUrl = ref(null)
    const previewUrl = ref(null)

    const form = useForm({
        title: '',
        body: '',
        thumbnail: '',
        preview: '',
        category_id: '',
        objectives: ''
    })

    const thumbnailChanged = () => {
        thumbnailUrl.value = URL.createObjectURL(form.thumbnail)
    }

    const previewChanged = () => {
        previewUrl.value = URL.createObjectURL(form.preview)
    }

    const submit = () => {
        form.post(route('courses.store'))
    }

    const removeThumbnail = () => {
        form.thumbnail = ''
    }

    const removePreview = () => {
        form.preview = ''
    }
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Course" />
        <form @submit.prevent="submit">
            <div>
                <div>
                    <InputLabel for="title" value="Title" />
                    <TextInput
                        id="title"
                        type="text"
                        v-model="form.title"
                        placeholder="title"
                        class="mt-2 w-full"
                    />
                </div>
                <div class="mt-4 md:flex md:space-x-2">
                    <div>
                        <InputLabel value="Preview" />
                        <div class="bg-grey-lighter mt-2">
                            <label v-if="!form.preview" class="w-72 h-44 flex flex-col items-center justify-center bg-white text-teal-400 rounded-lg shadow-sm tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-teal-500">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a video</span>
                                <TextInput
                                    type='file'
                                    class="hidden"
                                    @input="form.preview = $event.target.files[0]"
                                    @change="previewChanged"
                                />
                            </label>
                            <div v-if="form.preview" class="w-72 h-44">
                                <Player>
                                <!-- Provider component is placed here. -->
                                    <Video crossorigin="" poster="https://media.vimejs.com/poster.png">
                                      <source :data-src="previewUrl" type="video/mp4" />
                                    </Video>
                                    <DefaultUi noClickToPlay>
                                    <!-- We can place our own UI components here to extend the default UI. -->
                                    </DefaultUi>
                                </Player>
                                <!-- <video :src="previewUrl" class="w-full h-full" controls></video> -->
                                <div @click="removePreview" class="flex items-center justify-center text-red-600 bg-gray-200 p-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <InputLabel value="Thumnail" />
                        <div class="w-full bg-grey-lighter mt-2">
                            <label v-if="!form.thumbnail" class="w-72 h-44 flex flex-col items-center justify-center px-4 py-6 bg-white text-teal-400 rounded-lg shadow-sm tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-teal-500">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a image</span>
                                <TextInput
                                    type='file'
                                    class="hidden"
                                    @input="form.thumbnail = $event.target.files[0]"
                                    @change="thumbnailChanged"
                                    accept="image/*"
                                />
                            </label>
                            <div v-if="form.thumbnail" class="w-72 h-40">
                                <img :src="thumbnailUrl" class="w-full h-full">
                                <div @click="removeThumbnail" class="flex items-center justify-center text-red-600 bg-gray-200 p-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-11">
                    <InputLabel value="Body" />
                    <div class="mt-2">
                        <QuillEditor theme="snow" toolbar="full" v-model:content="form.body" contentType="html" />
                    </div>
                </div>
                <div class="mt-4">
                    <InputLabel value="Category" />
                    <select v-model="form.category_id" class="mt-2 border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm w-full">
                        <option value="">Select Category</option>
                    </select>
                </div>
                <div class="mt-4">
                    <InputLabel for="objectives" value="Objectives" />
                    <textarea v-model="form.objectives" id="objectives" class="mt-2 border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm w-full" placeholder="ex. overview of photoshop,mastering ai photoshop"></textarea>
                </div>
            </div>
            <PrimaryButton class="mt-4">
                Create Course
            </PrimaryButton>
        </form>
    </AuthenticatedLayout>
</template>
