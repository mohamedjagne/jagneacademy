<script setup>
import DashboardCard from "@/Components/DashboardCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ref } from "vue";

defineProps({
    todayStudents: Number,
    thisMonthStudents: Number,
    todayRevenue: Number,
    thisMonthRevenue: Number,
});

const date = ref([
    new Date(),
    new Date(new Date().setDate(new Date().getDate() + 7)),
]);

const type = ref("New Students");

const options = ref({
    chart: {
        id: "vuechart-example",
    },
    xaxis: {
        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
    },
});
const series = [
    {
        name: "series-1",
        data: [30, 40, 45, 50, 49, 60, 70, 91],
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="md:flex md:space-x-3 md:space-y-0 space-y-3">
            <div class="w-full">
                <VueDatePicker
                    v-model="date"
                    range
                    format="dd-MM-yyyy"
                ></VueDatePicker>
            </div>
            <div class="w-full">
                <select
                    v-model="type"
                    id="type"
                    class="w-full border-teal-300 focus:border-teal-300 focus:ring-teal-400 rounded-md shadow-sm text-sm"
                >
                    <option value="New Students">New Students</option>
                    <option value="Course Sales">Course Sales</option>
                    <option value="Revenue">Revenue</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <apexchart
                width="100%"
                type="line"
                :options="options"
                :series="series"
            ></apexchart>
        </div>
        <div class="md:flex md:space-x-3">
            <div class="space-y-3 mt-6 w-full">
                <h1 class="text-2xl font-bold">Today</h1>
                <DashboardCard :count="todayStudents" title="New Student" />
                <DashboardCard
                    :count="'$' + todayRevenue.toFixed(2)"
                    title="Revenue"
                />
                <DashboardCard count="0" title="Lesson Completion" />
                <DashboardCard count="0" title="Course Completion" />
            </div>
            <div class="space-y-3 mt-6 w-full">
                <h1 class="text-2xl font-bold">This Month</h1>
                <DashboardCard :count="thisMonthStudents" title="New Student" />
                <DashboardCard
                    :count="'$' + thisMonthRevenue.toFixed(2)"
                    title="Revenue"
                />
                <DashboardCard count="0" title="Lesson Completion" />
                <DashboardCard count="0" title="Course Completion" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
