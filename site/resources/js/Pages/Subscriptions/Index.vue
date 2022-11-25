<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['subscriptions'])
</script>

<template>
    <Head title="Subscriptions Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Subscriptions Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="subscription in subscriptions" class="p-6 text-gray-900">
                        {{ subscription.name }} - {{ subscription.monthly_cost }}€/month - {{ subscription.discount_percentage }}% of discount
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
