<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const imageUrl = ref(null);

const form = useForm({
    category_name: "",
    image: "",
});

const imageChanged = () => {
    imageUrl.value = URL.createObjectURL(form.image);
};

const removeImage = () => {
    form.image = null;
};

const submit = () => {
    form.post(route("categories.store"));
};

defineProps({
    errors: Object,
});
</script>

<template>
    <Head title="Create Category" />
    <AuthenticatedLayout>
        <form @submit.prevent="submit">
            <div>
                <div class="w-full md:w-1/2">
                    <InputLabel
                        for="category_name"
                        value="Category Name"
                        class="mt-8"
                    />
                    <TextInput
                        id="category_name"
                        type="text"
                        class="mt-2 w-full"
                        placeholder="category name"
                        v-model="form.category_name"
                        autofocus
                    />
                    <InputError :message="errors.category_name" class="mt-1" />
                </div>
                <div class="mt-4">
                    <InputLabel value="image" />
                    <div class="w-full bg-grey-lighter mt-2">
                        <label
                            v-if="!form.image"
                            class="w-60 h-32 flex flex-col items-center px-4 py-6 bg-white text-teal-400 rounded-lg shadow-sm tracking-wide uppercase border cursor-pointer hover:bg-blue hover:text-teal-500"
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
                                >Select a image</span
                            >
                            <TextInput
                                type="file"
                                class="hidden"
                                @input="form.image = $event.target.files[0]"
                                @change="imageChanged"
                            />
                        </label>
                        <div v-if="form.image" class="w-60 h-32">
                            <img :src="imageUrl" class="w-full h-full" />
                            <div
                                @click="removeImage"
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
                <InputError :message="errors.image" class="mt-8" />
            </div>
            <div class="mt-11">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Add Category
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
