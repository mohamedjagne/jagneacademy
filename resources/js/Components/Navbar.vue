<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const showMenu = ref(false);
</script>

<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900 text-sm">
        <div
            class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
        >
            <Link href="/" class="flex items-center">
                <img
                    src="/images/jagneacademy-logo-flex.png"
                    class="w-40 mr-3"
                    alt="Jagneacademy Logo"
                />
            </Link>
            <button
                @click="showMenu = !showMenu"
                type="button"
                class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            >
                <span class="sr-only">Open main menu</span>
                <svg
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </button>
            <div
                :class="showMenu ? '' : 'hidden'"
                class="w-full md:block md:w-auto"
            >
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                >
                    <li>
                        <Link
                            href="/"
                            :class="{
                                'text-white bg-teal-400 rounded md:bg-transparent md:text-teal-300 md:p-0 dark:text-white md:dark:text-teal-300':
                                    $page.url == '/',
                            }"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >Home</Link
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >About</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >Courses</a
                        >
                    </li>
                    <li v-if="!$page.props.auth.user">
                        <Link
                            :href="route('login')"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >Signin</Link
                        >
                    </li>
                    <li v-if="!$page.props.auth.user">
                        <Link
                            :href="route('register')"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >Signup</Link
                        >
                    </li>
                    <li
                        v-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.role_id == 3
                        "
                    >
                        <Link
                            :href="route('student.account')"
                            :class="{
                                'text-white bg-teal-400 rounded md:bg-transparent md:text-teal-300 md:p-0 dark:text-white md:dark:text-teal-300':
                                    $page.url.startsWith('/student'),
                            }"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >Account</Link
                        >
                    </li>
                    <li
                        v-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.role_id !== 3
                        "
                    >
                        <Link
                            :href="route('dashboard')"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >dashboard</Link
                        >
                    </li>
                    <li v-if="$page.props.auth.user">
                        <Link
                            as="button"
                            method="post"
                            :href="route('logout')"
                            class="block py-2 pl-3 pr-4 w-full text-start text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-teal-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            >Logout</Link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
