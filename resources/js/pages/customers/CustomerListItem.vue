<script setup>
import { formatDate } from "../../helper.js";

// define Props
defineProps({
    key: Number,
    customer:Object,
    index: Number
});

// define Emits
const emit = defineEmits('editCustomer');

// define Methods
const editCustomer = (customer) => {
    emit('editCustomer', customer);
};

</script>

<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ customer.f_name }}</td>
        <td>{{ customer.l_name }}</td>
        <td>{{ customer.email_address }}</td>
        <td>{{ customer.phone_number }}</td>
        <td>{{ customer.addrs }}</td>
        <td>{{ formatDate(customer.created) }}</td>
        <td>
            <a
                href="#"
                @click.prevent="editCustomer(customer)"
                class="btn btn-sm btn-primary"
            >
                <i class="fas fa-edit"></i>
            </a>
        </td>
    </tr>
</template>
