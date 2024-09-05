<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RequestElement from '@/Components/ApplicationElement.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['applications', 'companies']);

const form = useForm({
    item_id: '',
    item: '',
    qta: 1,
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
                <form v-if="false" @submit.prevent="form.post(route('applications.store'), { onSuccess: () => form.reset() })">
                    <label>Type</label>
                    <select v-model="form.type"  class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0">Take</option>
                        <option value="1">Buy</option>
                    </select>
                    <InputError :message="form.errors.type" class="mb-4" />

                    <label>Item</label>
                    <select v-if="form.type === 0"  v-model="form.item_id" class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">Select</option>
                        <option v-for="it in companies" :key="it" :value="it.id">{{ it.name }}</option>
                    </select>
                    <input
                        v-else
                        v-model="form.item"
                        class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.item_id" class="mb-4" v-if="form.type === 0" />
                    <InputError :message="form.errors.item" class="mb-4" v-else />

                    <label>Quantity</label>
                    <input
                        v-model="form.qta"
                        min="1"
                        :disabled="form.type === 1"
                        type="number"
                        class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.qta" class="mb-4" />
                    <PrimaryButton class="mt-4 mb-6">Send Request</PrimaryButton>
                </form>
                <div class=" bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y">
                    <RequestElement
                        v-for="req in applications"
                        :key="req.id"
                        :request="req"
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
