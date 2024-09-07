<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
 
dayjs.extend(relativeTime);

const props = defineProps(['application', 'companies']);
 
const form = useForm({
    status: props.application.status,
    type: props.application.type,
    id: props.application.id,
    company_id: props.application.company_id,
    role: props.application.role,
    notes: props.application.notes
});

const status = [
    'Sent', 'Ignored', 'Rejected', 'Technical Test', 'Offer'
];

const type = [
    'Remote', 'Hybrid', 'Office'
];

const editing = ref(false);

const getItemById = (id) => {
    let con = Object.entries(props.companies);
    let find = con.filter(el => {
        return el[1].id === id
    });

    return find[0][1].name;
}

</script>
 
<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800 dark:text-gray-200">#{{ application.id }}</span>
                    <small v-if="application.created_at === application.updated_at" class="text-sm text-gray-600 dark:text-gray-400"> - created {{ dayjs(application.created_at).fromNow() }}</small>
                    <small v-else class="text-sm text-gray-600 dark:text-gray-400"> - edited {{ dayjs(application.updated_at).fromNow() }}</small>
                </div>
                <Dropdown>
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 dark:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
                            Edit
                        </button>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing" @submit.prevent="form.put(route('applications.update', application.id), { onSuccess: () => editing = false })">
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

                <input type="hidden" v-model="form.id" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Update</PrimaryButton>
                    <button class="text-gray-900 dark:text-gray-100 mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <div v-else class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                <p>Company: {{ getItemById(application.company_id) }}</p>
                <p>Status: {{ status[application.status] }}</p>
                <p>Type: {{ type[application.type] }}</p>
                <p>Role: {{ application.role }}</p>
                <p>Notes: {{ application.notes }}</p>
            </div>
        </div>
    </div>
</template>
