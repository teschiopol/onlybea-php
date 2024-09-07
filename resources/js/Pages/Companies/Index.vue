<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CompanyElement from '@/Components/CompanyElement.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps(['companies']);

const form = useForm({
    name: '',
    hq: ''
});

const search = ref('');

const filteredItems = computed(() => {
  let res = Object.values(props.companies);

  if (!search.value) {
    return res;
  }

  return res.filter((item) => {
    return item.name.toLowerCase().includes(search.value.toLowerCase()) || item.hq.toLowerCase().includes(search.value.toLowerCase());
  });
});
</script>
 
<template>
    <Head title="Companies" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="form.post(route('companies.store'), { onSuccess: () => form.reset() })">
                    <label class="text-gray-900 dark:text-gray-100">Name</label>
                    <input
                        v-model="form.name"
                        placeholder="Acme"
                        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.name" class="mb-4" />
                    <label class="text-gray-900 dark:text-gray-100">Headquarter</label>
                    <input
                        v-model="form.hq"
                        placeholder="Milan"
                        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></input>
                    <InputError :message="form.errors.hq" class="mb-4" />
                    <PrimaryButton class="mt-4 mb-6">Save Company</PrimaryButton>
                </form>

                <label class="text-gray-900 dark:text-gray-100">Filter Company</label>
                <input
                    type="text" v-model="search" autocomplete="off"
                    class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></input>
               
                <div class=" bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y">
                    <CompanyElement
                        v-for="item in filteredItems"
                        :key="item.id"
                        :item="item"
                    />
                </div>

                <div v-if="companies.length < 1" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">No companies yet!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
