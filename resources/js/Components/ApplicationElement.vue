<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
 
dayjs.extend(relativeTime);

const props = defineProps(['request', 'items']);
 
const form = useForm({
    status: props.request.status,
    id: props.request.id,
});

const status = [
    'Pending', 'Approved', 'Rejected'
];

const type = [
    'Take', 'Buy'
];

const editing = ref(false);

const getItemById = (id) => {
    let con = Object.entries(props.items);
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
                    <span class="text-gray-800">#{{ request.id }} from {{ request.user.name }}</span>
                    <small v-if="request.created_at === request.updated_at" class="text-sm text-gray-600"> - created {{ dayjs(request.created_at).fromNow() }}</small>
                    <small v-else class="text-sm text-gray-600"> - edited {{ dayjs(request.updated_at).fromNow() }}</small>
                </div>
                <Dropdown v-if="$page.props.auth.user.is_admin && request.status === 0">
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
                            Edit
                        </button>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing" @submit.prevent="form.put(route('requests.update', request.id), { onSuccess: () => editing = false })">
                <label>Status</label>
                    <select v-model="form.status" class="mb-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                    </select>
                <InputError :message="form.errors.status" class="mb-4" />
                <input type="hidden" v-model="form.id" />
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Update</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <div v-else class="mt-4 text-lg text-gray-900">
                <p>Type: {{ type[request.type] }}</p>
                <p v-if="request.type === 0">Item: {{ getItemById(request.item_id) }}</p>
                <p v-else>Item: {{ request.item }}</p>
                <p>Quantity requested: {{ request.qta }}</p>
                <p>Status: {{ status[request.status] }}</p>
            </div>
        </div>
    </div>
</template>
