<script setup>
import Footer from "@/Components/Footer.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Navbar from "@/Components/Navbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    errors: Object,
    course: Object,
    student: Object,
});

const form = useForm({
    fullname: "",
    region: "",
    address: "",
    phone: "",
    order_note: "",
    payment_method: "",
});

const submit = () => {
    form.post(route("course.store.checkout", props.course.id));
};
</script>

<template>
    <Head :title="course.title" />
    <Navbar />
    <form @submit.prevent="submit">
        <div class="max-w-6xl mx-auto my-8 px-4">
            <div class="md:flex md:space-x-4">
                <div v-if="!student" class="w-full">
                    <h1 class="my-4 font-bold text-2xl">Billing details</h1>
                    <div>
                        <InputLabel
                            for="fullname"
                            value="Fullname"
                            class="mt-2"
                        />
                        <TextInput
                            id="fullname"
                            type="text"
                            v-model="form.fullname"
                            placeholder="fullname"
                            class="mt-2 w-full"
                        />
                        <InputError :message="errors.fullname" />
                    </div>
                    <div>
                        <InputLabel for="region" value="Region" class="mt-2" />
                        <TextInput
                            id="region"
                            type="text"
                            v-model="form.region"
                            placeholder="region"
                            class="mt-2 w-full"
                        />
                        <InputError :message="errors.region" />
                    </div>
                    <div>
                        <InputLabel
                            for="address"
                            value="Address"
                            class="mt-2"
                        />
                        <TextInput
                            id="address"
                            type="text"
                            v-model="form.address"
                            placeholder="address"
                            class="mt-2 w-full"
                        />
                        <InputError :message="errors.address" />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Phone" class="mt-2" />
                        <TextInput
                            id="phone"
                            type="number"
                            v-model="form.phone"
                            placeholder="phone"
                            class="mt-2 w-full"
                        />
                        <InputError :message="errors.phone" />
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <h1 class="my-4 font-bold text-2xl">
                            Select payment method
                        </h1>
                        <InputLabel
                            for="payment_method"
                            value="Payment Method"
                            class="mt-2"
                        />
                        <select
                            v-model="form.payment_method"
                            id="payment_method"
                            class="mt-2 w-full border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm"
                        >
                            <option value="">Select</option>
                            <option value="zaad">Zaad</option>
                            <option value="evc">Evc</option>
                            <option value="sahal">Sahal</option>
                            <option value="edahab">Edahab</option>
                        </select>
                        <InputError :message="errors.payment_method" />
                    </div>
                    <div>
                        <h1 class="my-4 font-bold text-2xl">
                            Additional information
                        </h1>
                        <InputLabel
                            for="order_note"
                            value="Order Note"
                            class="mt-2"
                        />
                        <textarea
                            v-model="form.order_note"
                            id="order_note"
                            placeholder="Qaabka lacagta aad ku soo bixisay iyo numberka aad ka soo dirtay sido kale magaca numberkaasi ku qoran"
                            class="mt-2 w-full border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm"
                        ></textarea>
                        <InputError :message="errors.order_note" />
                    </div>
                </div>
            </div>
            <h1 class="my-4 font-bold text-2xl">Your order</h1>
            <div>
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
                    </tbody>
                </table>
                <div class="flex items-center justify-end mt-6">
                    <PrimaryButton>Checkout</PrimaryButton>
                </div>
            </div>
        </div>
    </form>
    <Footer />
</template>
