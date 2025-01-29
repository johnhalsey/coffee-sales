<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PanelTemplate from '@/Components/Panel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

import { Head } from '@inertiajs/vue3';
import {computed, onMounted, ref} from "vue"

const quantity = ref(0);
const unitPrice = ref(0);
const selectedProduct = ref(null);

const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
    shipping: {
        type: Number,
        default: true,
    },
})

const errorBag = ref([]);

const errorsHas = (field) => {
    return errorBag.value.hasOwnProperty(field);
}

const errorsGet = (field) => {
    if (errorsHas(field)) {
        return errorBag.value[field][0];
    }
}

const sellingPrice = computed(() => {
    if (quantity.value === 0 || unitPrice.value === 0) {
        return 0;
    }

    let totalCost = parseFloat(quantity.value * unitPrice.value);
    let sellingPrice = (totalCost / (1 - selectedProduct.value.markup)) + props.shipping;
    let rounded = Math.ceil(sellingPrice * 100) / 100;
    return rounded.toFixed(2)
})

const recordSale = () => {
    window.axios.post('/api/sales', {
        quantity: quantity.value,
        unit_cost: unitPrice.value,
        selling_cost: sellingPrice.value,
        product_id: selectedProduct.value.id,
    }).then(() => {
        quantity.value = 0;
        unitPrice.value = 0;
        errorBag.value = [];
        getSales();
    }).catch((error) => {
        errorBag.value = error.response.data.errors;
    });
}

onMounted(() => {
    selectedProduct.value = props.products.data[0];
    getSales();
})

const sales = ref([]);

const getSales = () => {
    window.axios.get('/api/sales').then((response) => {
        sales.value = response.data.data;
    });
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Coffee Sales
            </h2>
        </template>

        <PanelTemplate>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-5">
                <div>
                    <InputLabel>Select a product</InputLabel>
                    <select v-model="selectedProduct">
                        <option v-for="product in products.data"
                                :key="'product-' + product.id"
                                :value="product"
                                @change="selectedProduct = product"
                        >
                            {{ product.name }}
                        </option>
                    </select>
                </div>

                <div>
                    <InputLabel>Quantity</InputLabel>
                    <TextInput v-model.number="quantity"></TextInput>
                    <InputError v-if="errorsHas('quantity')"
                                class="mt-3"
                                :message="errorsGet('quantity')"
                    ></InputError>
                </div>
                <div>
                    <InputLabel>Unit Price</InputLabel>
                    <TextInput v-model.number="unitPrice"></TextInput>
                    <InputError v-if="errorsHas('unit_cost')"
                                class="mt-3"
                                :message="errorsGet('unit_cost')"
                    ></InputError>
                </div>
                <div>
                    Selling Price
                    <div>
                        £{{ sellingPrice }}
                    </div>
                    <InputError v-if="errorsHas('selling_cost')"
                                class="mt-3"
                                :message="errorsGet('selling_cost')"
                    ></InputError>
                </div>
                <div class="flex">
                    <PrimaryButton class="self-end"
                                   @click="recordSale"
                    >
                        Record Sale
                    </PrimaryButton>
                </div>

            </div>
        </PanelTemplate>

        <PanelTemplate>
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="text-left">Product</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Unit Cost</th>
                    <th class="text-left">Selling Cost</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="sale in sales" :key="sale.id">
                    <td>{{ sale.product.name }}</td>
                    <td>{{ sale.quantity }}</td>
                    <td>£{{ sale.unit_cost }}</td>
                    <td>£{{ sale.selling_cost }}</td>
                </tr>
                </tbody>
            </table>
        </PanelTemplate>
    </AuthenticatedLayout>
</template>
