<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);

const sideOpen = ref(false);

const sideOutsideClicked = () => {
    sideOpen.value = false;
};

const vClickOutside = {
    mounted(el, binding) {
        el.ClickOutsideHandler = (event) => {
            if (!(el == event.target || el.contains(event.target))) {
                binding.value(event);
            }
        };
        document.body.addEventListener("click", el.ClickOutsideHandler);
    },
    unmounted(el) {
        document.body.removeEventListener("click", el.ClickOutsideHandler);
    },
};
</script>

<template>
    <div>
        <nav
            class="fixed top-0 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 z-40"
        >
            <div class="px-3 py-2 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div
                        v-click-outside="sideOutsideClicked"
                        class="flex items-center justify-start"
                    >
                        <button
                            @click="sideOpen = true"
                            type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        >
                            <span class="sr-only">Open sidebar</span>
                            <svg
                                class="w-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                    <div class="ml-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    >
                                        {{ $page.props.auth.user.name }}

                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </nav>

        <aside
            :class="[sideOpen ? 'translate-x-0 ' : '-translate-x-100']"
            class="fixed top-0 left-0 z-40 w-52 h-screen border-r border-gray-200 transition-transform -translate-x-full md:translate-x-0 pb-16"
        >
            <div class="px-3 py-2 bg-white border-b border-gray-200">
                <Link href="/">
                    <img
                        class="w-36"
                        src="/images/jagneacademy-logo-flex.png"
                    />
                </Link>
            </div>

            <nav
                class="h-full px-3 py-3 overflow-y-auto bg-gray-50 dark:bg-gray-800 space-y-2"
            >
                <div class="space-y-2">
                    <label
                        class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400"
                        >analytics</label
                    >

                    <Link
                        :href="route('dashboard')"
                        :class="{
                            'bg-teal-300 text-gray-900':
                                $page.url.startsWith('/dashboard'),
                        }"
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605"
                            />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Dashboard</span>
                    </Link>
                </div>

                <div class="space-y-2">
                    <label
                        class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400"
                        >content</label
                    >

                    <a
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                            />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Posts</span>
                    </a>

                    <Link
                        :href="route('courses')"
                        :class="{
                            'bg-teal-300 text-gray-900':
                                $page.url.startsWith('/courses'),
                        }"
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                            />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Courses</span>
                    </Link>

                    <a
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12"
                            />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Quiz</span>
                    </a>
                </div>

                <div class="space-y-2">
                    <label
                        class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400"
                        >Operations</label
                    >

                    <a
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 w-5"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(71, 85, 105, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path
                                d="M20 3H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h4l-1.8 2.4 1.6 1.2 2.7-3.6h3l2.7 3.6 1.6-1.2L16 18h4c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 16V5h16l.001 11H4z"
                            ></path>
                            <path d="M6 12h4v2H6z"></path>
                        </svg>

                        <span class="mx-2 text-sm font-medium"
                            >Instructors</span
                        >
                    </a>

                    <a
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 w-5"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(71, 85, 105, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path
                                d="M12 10c1.151 0 2-.848 2-2s-.849-2-2-2c-1.15 0-2 .848-2 2s.85 2 2 2zm0 1c-2.209 0-4 1.612-4 3.6v.386h8V14.6c0-1.988-1.791-3.6-4-3.6z"
                            ></path>
                            <path
                                d="M19 2H5c-1.103 0-2 .897-2 2v13c0 1.103.897 2 2 2h4l3 3 3-3h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-5 15-2 2-2-2H5V4h14l.002 13H14z"
                            ></path>
                        </svg>

                        <span class="mx-2 text-sm font-medium">Students</span>
                    </a>

                    <a
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(71, 85, 105, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path d="M3 3v17a1 1 0 0 0 1 1h17v-2H5V3H3z"></path>
                            <path
                                d="M15.293 14.707a.999.999 0 0 0 1.414 0l5-5-1.414-1.414L16 12.586l-2.293-2.293a.999.999 0 0 0-1.414 0l-5 5 1.414 1.414L13 12.414l2.293 2.293z"
                            ></path>
                        </svg>

                        <span class="mx-2 text-sm font-medium">Sales</span>
                    </a>
                </div>
                <div class="space-y-2">
                    <label
                        class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400"
                        >Customization</label
                    >

                    <Link
                        :href="route('categories')"
                        :class="{
                            'bg-teal-300 text-gray-900':
                                $page.url.startsWith('/categories'),
                        }"
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 w-5"
                            viewBox="0 0 24 24"
                            style="
                                fill: rgba(71, 85, 105, 1);
                                transform: ;
                                msfilter: ;
                            "
                        >
                            <path
                                d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"
                            ></path>
                        </svg>

                        <span class="mx-2 text-sm font-medium">Categories</span>
                    </Link>

                    <a
                        class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-teal-300 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-900"
                        href="#"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                            />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Users</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Page Content -->
        <main class="min-h-screen text-gray-800 md:ml-52">
            <div class="md:px-14 px-4 py-20">
                <slot />
            </div>
        </main>
    </div>
</template>
