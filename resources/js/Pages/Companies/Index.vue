<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ItemElement from '@/Components/CompanyElement.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps(['items', 'canCreate']);

const form = useForm({
    name: '',
    color: '',
    availability: 0,
    category: 0
});

const search = ref('');

const filteredItems = computed(() => {
  let res = Object.values(props.items);

  if (!search.value) {
    return res;
  }

  return res.filter((item) => {
    return parseInt(item.category) === parseInt(search.value)
  });
});
</script>
 
<template>
    <Head title="Items" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Items</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form v-if="canCreate" @submit.prevent="form.post(route('items.store'), { onSuccess: () => form.reset() })">
                    <label>Name</label>
                    <input
                        v-model="form.name"
                        placeholder="Best Keyboard"
                        class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.name" class="mb-4" />
                    <label>Availability</label>
                    <input
                        v-model="form.availability"
                        min="0"
                        type="number"
                        class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.availability" class="mb-4" />
                    <label>Category</label>
                    <select v-model="form.category"  class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0">None</option>
                        <option value="1">Hard</option>
                        <option value="2">Soft</option>
                        <option value="3">Useless</option>
                        <option value="4">Need</option>
                    </select>
                    <InputError :message="form.errors.category" class="mb-4" />
                    <label>Color</label>
                    <input
                        v-model="form.color"
                        placeholder="Purple"
                        class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.color" class="mb-4" />
                    <PrimaryButton class="mt-4 mb-6">Create Item</PrimaryButton>
                </form>

                <label>Filter Category</label>
                <select v-model="search" class="mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="">All</option>
                    <option value="0">None</option>
                    <option value="1">Hard</option>
                    <option value="2">Soft</option>
                    <option value="3">Useless</option>
                    <option value="4">Need</option>
                </select>

                <div class=" bg-white shadow-sm rounded-lg divide-y">
                    <ItemElement
                        v-for="item in filteredItems"
                        :key="item.id"
                        :item="item"
                    />
                </div>

                <div v-if="items.length < 1" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">No item available now!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
