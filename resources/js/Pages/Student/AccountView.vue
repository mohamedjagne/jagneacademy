<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import { Link, Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Student Account" />
    <Navbar />
    <div
        class="border-b border-gray-200 dark:border-gray-700 max-w-6xl mx-auto my-4 px-4"
    >
        <ul
            class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400"
        >
            <li class="mr-2">
                <Link
                    :href="route('student.account')"
                    :class="{
                        'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300':
                            $page.url === '/student/account',
                    }"
                    class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                >
                    <svg
                        :class="{
                            'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                $page.url === '/student/account',
                        }"
                        class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                        /></svg
                    >Account
                </Link>
            </li>
            <li class="mr-2">
                <Link
                    href="route('course.sections', id)"
                    :class="{
                        'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300 group':
                            $page.url.startsWith(`/courses/${id}/sections`),
                    }"
                    class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                >
                    <svg
                        :class="{
                            'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                $page.url.startsWith(`/courses/${id}/sections`),
                        }"
                        class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                        /></svg
                    >My Courses
                </Link>
            </li>
            <li class="mr-2">
                <Link
                    href="route('course.lessons', id)"
                    :class="{
                        'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300 group':
                            $page.url.startsWith(`/courses/${id}/lessons`),
                    }"
                    class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                >
                    <svg
                        :class="{
                            'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                $page.url.startsWith(`/courses/${id}/lessons`),
                        }"
                        class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 01-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 00-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 01-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 00.657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 005.427-.63 48.05 48.05 0 00.582-4.717.532.532 0 00-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 00.658-.663 48.422 48.422 0 00-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 01-.61-.58v0z"
                        /></svg
                    >My Quiz
                </Link>
            </li>
            <li class="mr-2">
                <Link
                    href="route('course.lessons', id)"
                    :class="{
                        'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300 group':
                            $page.url.startsWith(`/courses/${id}/lessons`),
                    }"
                    class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                >
                    <svg
                        :class="{
                            'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                $page.url.startsWith(`/courses/${id}/lessons`),
                        }"
                        class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                        /></svg
                    >Question and Answer
                </Link>
            </li>
            <li class="mr-2">
                <Link
                    href="route('course.lessons', id)"
                    :class="{
                        'text-teal-400 border-teal-500 dark:text-teal-300 dark:border-teal-400 hover:text-teal-500 hover:border-teal-500 dark:hover:text-teal-300 group':
                            $page.url.startsWith(`/courses/${id}/lessons`),
                    }"
                    class="inline-flex items-center justify-center py-3 px-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                >
                    <svg
                        :class="{
                            'text-teal-500 dark:text-teal-400 group-hover:text-teal-500 dark:group-hover:text-teal-300':
                                $page.url.startsWith(`/courses/${id}/lessons`),
                        }"
                        class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                        /></svg
                    >Profile
                </Link>
            </li>
        </ul>
    </div>
    <div
        class="max-w-6xl mx-auto my-4 md:flex md:items-center md:space-x-3 space-x-0 space-y-2 md:space-y-0 px-4"
    >
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center"
        >
            <div class="flex items-center justify-center">
                <svg
                    class="w-11 h-11 text-teal-400 bg-teal-100 p-2 rounded-full"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                    />
                </svg>
            </div>

            <h5
                class="my-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
            >
                0
            </h5>
            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                Enrolled Courses
            </p>
        </div>
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center"
        >
            <div class="flex items-center justify-center">
                <svg
                    class="w-11 h-11 text-teal-400 bg-teal-100 p-2 rounded-full"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                    />
                </svg>
            </div>

            <h5
                class="my-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
            >
                0
            </h5>
            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                Active Courses
            </p>
        </div>
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center"
        >
            <div class="flex items-center justify-center">
                <svg
                    class="w-11 h-11 text-teal-400 bg-teal-100 p-2 rounded-full"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                    />
                </svg>
            </div>

            <h5
                class="my-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
            >
                0
            </h5>
            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                Completed Courses
            </p>
        </div>
    </div>
    <Footer />
</template>
