<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['employees'])
</script>

<template>
    <Head title="Employees Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="employee in employees" class="p-6 text-gray-900">
                        {{ employee.first_name }} {{ employee.last_name }} - {{ employee.salary }}€ - {{ employee.hiring_date }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
