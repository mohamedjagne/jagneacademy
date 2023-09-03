<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref, watch } from "vue";
import { Head, useForm, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    students: Array,
    search: String,
});

const deletedCourse = ref(null);

const search = ref(props.search);

watch(search, (value) => {
    if (value) {
        router.get(route("students"), { search: value });
    } else {
        router.get(route("students"));
    }
});

const confirmingCourseDeletion = ref(false);

const closeModal = () => {
    confirmingCourseDeletion.value = false;
};

const confirmCourseDeletion = (id) => {
    confirmingCourseDeletion.value = true;

    deletedCourse.value = id;
};

const form = useForm({});

const deleteCourse = () => {
    form.delete(route("courses.delete", deletedCourse.value), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Students List" />
        <div>
            <h1>Students List</h1>
            <div class="flex items-center justify-end mt-4">
                <TextInput
                    v-model="search"
                    type="search"
                    placeholder="Search..."
                />
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg mt-8">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Full Name</th>
                        <th scope="col" class="px-6 py-3">Region</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="student in students"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            <Link
                                :href="route('student.view', student.id)"
                                class="hover:underline hover:text-teal-400"
                            >
                                {{ student.full_name }}
                            </Link>
                        </th>
                        <td class="px-6 py-4">{{ student.region }}</td>
                        <td class="px-6 py-4">{{ student.phone }}</td>
                        <td class="px-6 py-4">{{ student.user.email }}</td>
                        <td class="px-6 py-4 flex items-center">
                            <div
                                class="cursor-pointer"
                                @click="confirmCourseDeletion(student.id)"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-4 text-red-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    />
                                </svg>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Modal :show="confirmingCourseDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete the course?
                </h2>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton class="ml-3" @click="deleteCourse">
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
