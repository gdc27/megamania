<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['customers']);
</script>

<template>
    <Head title="Customers Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="customer in customers" class="p-6 text-gray-900">
                        {{ customer.first_name }} {{ customer.last_name }} - {{ customer.email }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
