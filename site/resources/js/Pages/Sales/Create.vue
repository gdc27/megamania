<template>
    <Head title="Sales Create"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Create</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="addSale()">
                        <div>
                            <InputLabel>Vendeur</InputLabel>
                            <select v-model="form.employee_id">
                                <option v-for="emp in employees" :value="emp.id">{{ emp.first_name }} {{
                                        emp.last_name
                                    }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <InputLabel>Client</InputLabel>
                            <select v-model="form.customer_id">
                                <option v-for="cust in customers" :value="cust.id">{{ cust.first_name }}
                                    {{ cust.last_name }}
                                </option>
                            </select>
                        </div>
                        <div class="space-y-3">
                            <div v-for="pro in products" class="flex items-center space-x-2">
                                <input v-model="form.products[pro.id].checked" type="checkbox" :value="pro.id" :name="pro.name">
                                <InputLabel>{{ pro.name }}</InputLabel>
                                <input v-if="form.products[pro.id].checked" v-model="form.products[pro.id].qty" type="number" min="1" name="quantité">
                            </div>

                        </div>
                        <PrimaryButton class="mt-3">Add</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue"
import {Head} from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            form: {
                customer_id: '',
                employee_id: '',
                products: {},
            },
            test : []
        }
    },
    components: {
        AuthenticatedLayout,
        InputLabel,
        PrimaryButton,
        Head
    },
    props: ['employees', 'customers', 'products'],
    methods: {
        addSale() {
            this.$inertia.post(route('sales.store'), this.form);
            this.resetForm()
        },
        resetForm(){
            this.form =  {
                    customer_id: '',
                    employee_id: '',
                    products: {},
            }

            this.products.forEach(p =>{
                this.form.products[p.id] = {
                    checked : false,
                    qty : 1
                }
            })

        }
    },
    beforeMount() {
        this.resetForm()
    }
}

</script>
