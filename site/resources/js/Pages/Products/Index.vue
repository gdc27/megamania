<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['products'])
</script>

<template>
    <Head title="Products Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="product in products" class="p-6 text-gray-900">
                        {{ product.name }} - {{ product.description }} - {{ product.price }}€ - {{ product.stock }} left in stock
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
