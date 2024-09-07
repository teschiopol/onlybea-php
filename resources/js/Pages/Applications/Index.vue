<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ApplicationElement from '@/Components/ApplicationElement.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['applications', 'companies']);

const form = useForm({
    company_id: '',
    role: '',
    notes: '',
    status: 0,
    type: 0
});
</script>
 
<template>
    <Head title="Applications" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Applications</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <form v-if="companies.length > 0" @submit.prevent="form.post(route('applications.store'), { onSuccess: () => form.reset() })">

                    <label class="text-gray-900 dark:text-gray-100">Company</label>
                    <select v-model="form.company_id" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">Select</option>
                        <option v-for="it in companies" :key="it" :value="it.id">{{ it.name }}</option>
                    </select>
                    <InputError :message="form.errors.company_id" class="mb-4" />


                    <label class="text-gray-900 dark:text-gray-100">Status</label>
                    <select v-model="form.status" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0">Sent</option>
                        <option value="1">Ignored</option>
                        <option value="2">Rejected</option>
                        <option value="3">Technical Test</option>
                        <option value="4">Offer</option>
                    </select>
                    <InputError :message="form.errors.status" class="mb-4" />

                    <label class="text-gray-900 dark:text-gray-100">Type</label>
                    <select v-model="form.type" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0">Remote</option>
                        <option value="1">Hybrid</option>
                        <option value="2">Office</option>
                    </select>
                    <InputError :message="form.errors.type" class="mb-4" />

                    <label class="text-gray-900 dark:text-gray-100">Role</label>
                    <input
                        v-model="form.role"
                        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.role" class="mb-4" />

                    <label class="text-gray-900 dark:text-gray-100">Notes</label>
                    <input
                        v-model="form.notes"
                        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.notes" class="mb-4" />

                    <PrimaryButton class="mt-4 mb-6">Create Application</PrimaryButton>
                </form>
                <div class=" bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y">
                    <ApplicationElement
                        v-for="req in applications"
                        :key="req.id"
                        :application="req"
                        :companies="companies"
                    />
                </div>

                <div v-if="applications.length < 1" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">No applications for now!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
