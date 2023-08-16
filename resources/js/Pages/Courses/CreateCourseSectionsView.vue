<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    categories: Array,
    errors: Object,
    course: Object,
});

const form = useForm({
    title: "",
});

const submit = () => {
    form.post(route("courses.sections.store", props.course.id));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Course" />
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
            <PrimaryButton class="mt-4"> Create Section </PrimaryButton>
        </form>
    </AuthenticatedLayout>
</template>
