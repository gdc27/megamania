<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['sale', 'total_price', 'total_quantity'])
</script>

<template>
    <Head title="Sales Show" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Show</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div>
                            {{ sale.date }} - Vendeur : {{ sale.employee.first_name }} {{ sale.employee.last_name }} -
                            Client : {{ sale.customer.first_name }} {{ sale.customer.last_name }}
                        </div>
                        <div v-for="product in sale.products">
                            <div>
                                {{ product.name }} x{{ product.pivot.quantity }} - {{ product.price * product.pivot.quantity }}€
                            </div>
                        </div>
                        <div>
                            {{ total_quantity }} produits commandés pour un total de {{ total_price }}€
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
