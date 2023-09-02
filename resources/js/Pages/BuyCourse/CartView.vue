<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    course: Object,
});
</script>

<template>
    <Head :title="course.title" />
    <Navbar />
    <div class="max-w-6xl mx-auto my-11 px-4">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">Product name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td class="px-6 py-4">
                        <img
                            :src="'/storage/' + course.thumbnail"
                            class="w-11 h-8"
                        />
                    </td>
                    <td class="px-6 py-4">{{ course.title }}</td>
                    <td class="px-6 py-4">${{ course.price }}</td>
                </tr>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                </tr>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4">Subtotal</td>
                    <td class="px-6 py-4">${{ course.price }}</td>
                </tr>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4">Total</td>
                    <td class="px-6 py-4">${{ course.price }}</td>
                </tr>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                ></tr>
            </tbody>
        </table>
        <div class="flex items-center justify-end mt-6">
            <PrimaryButton>Proceed to checkout</PrimaryButton>
        </div>
    </div>
    <Footer />
</template>
