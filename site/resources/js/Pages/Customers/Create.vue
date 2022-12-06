<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";


// get the props from the server
defineProps(['subscriptions']);
const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    subscription_id: '',
})
</script>

<template>
    <Head title="Customers Create"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers Create</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="form.post(route('customers.store'), { onSuccess: () => form.reset() })">
                    <InputLabel>First name</InputLabel>
                    <TextInput
                        id="firstname"
                        type="text"
                        placeholder="Robin"
                        class="mt-1 block"
                        v-model="form.first_name"
                        required
                        autofocus
                    />
                    <InputLabel>Last name</InputLabel>
                    <TextInput
                        id="lastname"
                        type="text"
                        placeholder="Meunier"
                        class="mt-1 block"
                        v-model="form.last_name"
                        required
                    />
                    <InputLabel>Email</InputLabel>
                    <TextInput
                        id="email"
                        type="email"
                        placeholder="robin@gmail.com"
                        class="mt-1 block"
                        v-model="form.email"
                    />
                    <InputLabel>Abonnement</InputLabel>
                    <select v-model="form.subscription_id">
                        <option v-for="sub in subscriptions" :value="sub.id">
                            {{ sub.name }} - {{ sub.monthly_cost }}€ - {{ sub.discount_percentage }}%
                        </option>
                    </select>
                    <PrimaryButton class="mt-3">Add</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
