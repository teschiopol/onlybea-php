<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SingleCard from '@/Components/SingleCard.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

const props = defineProps([
    'total',
    'sent',
    'ignored',
    'reject',
    'tech',
    'offer',
    'remote',
    'hybrid',
    'office'       
]);

const requestData = ref({
    labels: ['Office', 'Remote', 'Hybrid'],
    datasets: [{
        backgroundColor: ['#bb1616', '#16bb3f', '#f8ea17'],
        data: [props.office, props.remote, props.hybrid]
    }]
});
const requestOptions = ref ({
    responsive: true,
    maintainAspectRatio: false,
});

const categoryData = ref({
    labels: ['Sent', 'Ignored', 'Rejected', 'Technical Test', 'Offer'],
    datasets: [{
        backgroundColor: [ 'rgb(54, 162, 235)', 'rgb(153, 102, 255)', 'rgb(255, 205, 86)'],
        data: [props.sent, props.ignored, props.reject, props.tech, props.offer]
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
            <h2 class="font-semibold text-xl text-gray-800  dark:text-gray-100 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <SingleCard title="Total" :counter="total" icon-color="blue" icon="pi-folder-open" />
                    <SingleCard title="Sent" :counter="sent" icon-color="purple" icon="pi-file-arrow-up" />
                    <SingleCard title="Ignored" :counter="ignored" icon-color="orange" icon="pi-ban" />
                    <SingleCard title="Reject" :counter="reject" icon-color="red" icon="pi-times" />
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 max-h-80 mb-2">
                            <p class="font-semibold text-center">Work Type</p>
                            <Pie
                                id="request-stats"
                                :options="requestOptions"
                                :data="requestData"
                            />
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 max-h-80 mb-2">
                            <p class="font-semibold text-center">Applications</p>
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
