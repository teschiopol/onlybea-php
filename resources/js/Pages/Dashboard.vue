<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

const requestData = ref({
    labels: ['Rejected', 'Approved', 'Pending'],
    datasets: [{
        backgroundColor: ['#bb1616', '#16bb3f', '#f8ea17'],
        data: [3, 10, 5]
    }]
});
const requestOptions = ref ({
    responsive: true,
    maintainAspectRatio: false,
});

const categoryData = ref({
    labels: ['None', 'Hard', 'Soft', 'Useless', 'Need'],
    datasets: [{
        backgroundColor: ['rgb(255, 159, 64)', 'rgb(54, 162, 235)', 'rgb(153, 102, 255)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)'],
        data: [3, 2, 1, 4, 5]
    }]
});
const categoryOptions = ref ({
    responsive: true,
    maintainAspectRatio: false
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-center">
                            <p class="font-semibold">Most Request</p>
                            <p>Keyboard</p>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-center">
                            <p class="font-semibold">User with Most Request</p>
                            <p>User 2</p>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 max-h-80	">
                            <p class="font-semibold text-center">Requests</p>
                            <Pie
                                id="request-stats"
                                :options="requestOptions"
                                :data="requestData"
                            />
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 max-h-80	">
                            <p class="font-semibold text-center">Categories</p>
                            <Pie
                                id="rcategory-stats"
                                :options="categoryOptions"
                                :data="categoryData"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
