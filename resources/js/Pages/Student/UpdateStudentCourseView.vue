<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    course: Object,
});

const form = useForm({
    status: props.course.student[0].pivot.status,
});

const submit = () => {
    form.put(
        route("student.course.update", [
            props.course.student[0].id,
            props.course.id,
        ])
    );
};
</script>

<template>
    <Head title="Update Student Course" />
    <AuthenticatedLayout>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="status" value="Status" class="mt-2" />
                <select
                    v-model="form.status"
                    id="status"
                    class="mt-2 w-full border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm"
                >
                    <option value="Pending">Pending</option>
                    <option value="Active">Active</option>
                </select>
            </div>
            <div class="mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Update
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
