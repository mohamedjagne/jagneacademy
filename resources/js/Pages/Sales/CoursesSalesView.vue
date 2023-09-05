<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    courses: Object,
});

const search = ref(props.search);

watch(search, (value) => {
    router.get(route("sales.courses"), {
        search: value,
    });
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Sections List" />
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul
                class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400"
            >
                <li class="mr-2">
                    <Link
                        :href="route('sales.transactions')"
                        :class="{
                            'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300':
                                $page.url === `/sales/transactions`,
                        }"
                        class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    >
                        <svg
                            :class="{
                                'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                    $page.url === `/sales/transactions`,
                            }"
                            class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M21 11h-3V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v14c0 1.654 1.346 3 3 3h14c1.654 0 3-1.346 3-3v-6a1 1 0 0 0-1-1zM5 19a1 1 0 0 1-1-1V5h12v13c0 .351.061.688.171 1H5zm15-1a1 1 0 0 1-2 0v-5h2v5z"
                            ></path>
                            <path
                                d="M6 7h8v2H6zm0 4h8v2H6zm5 4h3v2h-3z"
                            ></path></svg
                        >Transactions
                    </Link>
                </li>
                <li class="mr-2">
                    <Link
                        :href="route('sales.courses')"
                        :class="{
                            'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300 group':
                                $page.url.startsWith(`/sales/courses`),
                        }"
                        class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                    >
                        <svg
                            :class="{
                                'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                    $page.url.startsWith(`/sales/courses`),
                            }"
                            class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M2.047 14.668a.994.994 0 0 0 .465.607l1.91 1.104v2.199a1 1 0 0 0 1 1h2.199l1.104 1.91a1.01 1.01 0 0 0 .866.5c.174 0 .347-.046.501-.135L12 20.75l1.91 1.104a1.001 1.001 0 0 0 1.366-.365l1.103-1.91h2.199a1 1 0 0 0 1-1V16.38l1.91-1.104a1 1 0 0 0 .365-1.367L20.75 12l1.104-1.908a1 1 0 0 0-.365-1.366l-1.91-1.104v-2.2a1 1 0 0 0-1-1H16.38l-1.103-1.909a1.008 1.008 0 0 0-.607-.466.993.993 0 0 0-.759.1L12 3.25l-1.909-1.104a1 1 0 0 0-1.366.365l-1.104 1.91H5.422a1 1 0 0 0-1 1V7.62l-1.91 1.104a1.003 1.003 0 0 0-.365 1.368L3.251 12l-1.104 1.908a1.009 1.009 0 0 0-.1.76zM12 13c-3.48 0-4-1.879-4-3 0-1.287 1.029-2.583 3-2.915V6.012h2v1.109c1.734.41 2.4 1.853 2.4 2.879h-1l-1 .018C13.386 9.638 13.185 9 12 9c-1.299 0-2 .515-2 1 0 .374 0 1 2 1 3.48 0 4 1.879 4 3 0 1.287-1.029 2.583-3 2.915V18h-2v-1.08c-2.339-.367-3-2.003-3-2.92h2c.011.143.159 1 2 1 1.38 0 2-.585 2-1 0-.325 0-1-2-1z"
                            ></path></svg
                        >Courses
                    </Link>
                </li>
            </ul>
        </div>
        <div class="mt-3 md:flex md:items-center md:justify-between">
            <h1>Courses Sales</h1>
            <TextInput v-model="search" type="search" placeholder="Search..." />
        </div>

        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg mt-8">
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">#Students</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="course in courses"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <th
                            scope="row"
                            class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ course.title }}
                        </th>
                        <td class="px-6 py-3">{{ course.student_count }}</td>
                        <td class="px-6 py-3">${{ course.price }}</td>
                        <td class="px-6 py-3">
                            ${{
                                (course.student_count * course.price).toFixed(2)
                            }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
