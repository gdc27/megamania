<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps(['sales'])
</script>

<template>
    <Head title="Sales Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="sale in sales" class="p-6 text-gray-900 flex justify-between">
                        <div>
                            {{ sale.date }} {{ sale.totalPrice }}€
                            {{ sale.products_count }} produit(s) différent(s) -
                            Client : {{ sale.customer.first_name }} {{ sale.customer.last_name }} -
                            Vendeur : {{ sale.employee.first_name }} {{ sale.employee.last_name }}
                        </div>
                        <a :href="route('sales.show', sale.id)"><PrimaryButton>Détails</PrimaryButton></a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
