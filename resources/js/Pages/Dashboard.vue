<script setup>
import DashboardCard from "@/Components/DashboardCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { watch } from "vue";
import { ref } from "vue";

const props = defineProps({
    todayStudents: Number,
    thisMonthStudents: Number,
    todayRevenue: Number,
    thisMonthRevenue: Number,
    dates: Array,
    from: Date,
    to: Date,
    type: String,
    newStudents: Array,
});

const date = ref([props.from, props.to]);

const type = ref(props.type ?? "New Students");

watch(date, (value) => {
    router.get(route("dashboard", { date: value, type: type.value }));
});

watch(type, (value) => {
    router.get(route("dashboard", { date: date.value, type: value }));
});

const options = ref({
    chart: {
        type: "area",
        stacked: false,
        height: 350,
        zoom: {
            type: "x",
            enabled: true,
            autoScaleYaxis: true,
        },
        toolbar: {
            autoSelected: "zoom",
        },
    },
    dataLabels: {
        enabled: false,
    },
    markers: {
        size: 0,
    },
    title: {
        text: "Students, revenue and sales data",
        align: "left",
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: false,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 90, 100],
        },
    },
    xaxis: {
        type: "datetime",
        categories: props.dates,
    },
    tooltip: {
        shared: false,
    },
});
const series = [
    {
        name: "New Students",
        data: props.newStudents,
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
                type="area"
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
