<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  type: 'rental_agreement',
  parties: {
    party1: '',
    party2: '',
  },
  terms: {
    start_date: '',
    duration_months: '',
  },
});

const submit = () => {
  form.post(route('documents.store'), {
    onFinish: () => {
      // Potentially clear form or show a message
    }
  });
};
</script>

<template>
  <AppLayout title="Generate Document">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Generate Legal Document
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form @submit.prevent="submit">
            <div>
              <label for="type" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Document Type</label>
              <select id="type" v-model="form.type" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="rental_agreement">Rental Agreement</option>
                <option value="service_contract">Service Contract</option>
                <option value="nda">Non-Disclosure Agreement</option>
              </select>
            </div>

            <div class="mt-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Parties</h3>
                <div class="mt-2">
                    <label for="party1" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Party 1 Name</label>
                    <input type="text" id="party1" v-model="form.parties.party1" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
                 <div class="mt-2">
                    <label for="party2" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Party 2 Name</label>
                    <input type="text" id="party2" v-model="form.parties.party2" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
            </div>

            <div class="mt-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Terms</h3>
                 <div class="mt-2">
                    <label for="start_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Start Date</label>
                    <input type="date" id="start_date" v-model="form.terms.start_date" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
                <div class="mt-2">
                    <label for="duration_months" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Duration (in months)</label>
                    <input type="number" id="duration_months" v-model="form.terms.duration_months" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
            </div>


            <div class="flex items-center justify-end mt-4">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Generate
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template> 