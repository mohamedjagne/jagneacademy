<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("instructors.store"));
};

defineProps({
    errors: Object,
    roles: Array,
});
</script>

<template>
    <Head title="Create User" />
    <AuthenticatedLayout>
        <Link :href="route('instructors')">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 bg-gray-200 rounded px-1 py-1"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 19.5L8.25 12l7.5-7.5"
                />
            </svg>
        </Link>

        <form @submit.prevent="submit">
            <div class="md:flex md:space-x-2 mt-8">
                <div class="w-full md:w-1/2">
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-2 w-full"
                        placeholder="name"
                        v-model="form.name"
                    />
                    <InputError :message="errors.name" class="mt-1" />
                </div>
                <div class="w-full md:w-1/2">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="text"
                        class="mt-2 w-full"
                        placeholder="email"
                        v-model="form.email"
                    />
                    <InputError :message="errors.email" class="mt-1" />
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <InputLabel for="password" value="Password" class="mt-2" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-2 w-full"
                    placeholder="password"
                    v-model="form.password"
                />
                <InputError :message="errors.password" class="mt-1" />
            </div>
            <div class="mt-4 flex items-center justify-end w-full">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Add Instructor
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
