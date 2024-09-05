<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
 
dayjs.extend(relativeTime);

const props = defineProps(['item']);
 
const form = useForm({
    name: props.item.name,
    hq: props.item.hq
});
 
const editing = ref(false);
</script>
 
<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-900 dark:text-gray-100">{{ item.name }}</span>
                    <small v-if="item.created_at === item.updated_at" class="text-sm text-gray-600"> - created {{ dayjs(item.created_at).fromNow() }}</small>
                    <small v-else class="text-sm text-gray-600 dark:text-gray-200"> - edited {{ dayjs(item.updated_at).fromNow() }}</small>
                </div>
                <Dropdown>
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
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
            <form v-if="editing" @submit.prevent="form.put(route('companies.update', item.id), { onSuccess: () => editing = false })">
                <label class="text-gray-900 dark:text-gray-100">Name</label>
                <input v-model="form.name" class="mb-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></input>
                <InputError :message="form.errors.name" class="mb-4" />
                <label class="text-gray-900 dark:text-gray-100">Headquarter</label>
                <input v-model="form.hq" class="mb-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></input>
                <InputError :message="form.errors.hq" class="mb-4" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="text-gray-900 dark:text-gray-100 mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <div v-else class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                <p>Headquarter: {{ item.hq }}</p>
            </div>
        </div>
    </div>
</template>
