<script setup>
import { onMounted, ref, watch } from "vue";
import { Form, Field } from "vee-validate";
import * as yup from "yup";
import { useToastr } from "../../toastr.js";
import CustomerListItem from "./CustomerListItem.vue";
import { getCustomers, createCustomer, updateCustomer } from "./services/customerService";

// define constants
const customers = ref({ data: [] });
const editing = ref(false);
const formValues = ref();
const form = ref(null);
const toastr = useToastr();

// watch form values
watch(formValues, (newValues) => {
    if (form.value) {
        form.value.setValues(newValues);
    }
});

// create customer validation rules
const createCustomerSchema = yup.object({
    first_name: yup.string().required("First name is required"),
    last_name: yup.string().required("Last name is required"),
    email: yup
        .string()
        .email("Invalid email format")
        .required("Email is required"),
    phone: yup
        .string()
        .matches(
            /^\+44\d{10}$/,
            "Phone number must be in the format +44XXXXXXXXXX"
        )
        .required("Phone number is required"),
    address: yup.string().required("Address is required"),
});

// edit customer validation rules
const editCustomerSchema = yup.object({
    first_name: yup.string().required("First name is required"),
    last_name: yup.string().required("Last name is required"),
    email: yup
        .string()
        .email("Invalid email format")
        .required("Email is required"),
    phone: yup
        .string()
        .matches(
            /^\+44\d{10}$/,
            "Phone number must be in the format +44XXXXXXXXXX"
        )
        .required("Phone number is required"),
    address: yup.string().required("Address is required"),
});

// get customers from the database
const getCustomersAction = async () => {
    try {
        const response = await getCustomers();
        customers.value = response.data.data;
    } catch (error) {
        console.error(error);
        toastr.error("Error fetching customers");
    }
};

//add customer
const addCustomer = () => {
    editing.value = false;
    $("#customerFormModal").modal("show");
    form.value.resetForm();
};

// edit customer
const editCustomer = (customer) => {
    editing.value = true;
    form.value.resetForm();
    $("#customerFormModal").modal("show");
    formValues.value = {
        id: customer.id,
        first_name: customer.f_name,
        last_name: customer.l_name,
        email: customer.email_address,
        phone: customer.phone_number,
        address: customer.addrs,
    };
};

// save new customer
const createCustomerAction = async (values, { resetForm, setErrors }) => {
    try {
        const response = await createCustomer(values);
        customers.value.unshift(response.data);
        $("#customerFormModal").modal("hide");
        resetForm();
        toastr.success("Customer created successfully!");
    } catch (error) {
        if (error.response && error.response.data.errors) {
            setErrors(error.response.data.errors);
        }
        toastr.error("Error creating customer");
    }
};

// update customer
const updateCustomerAction = async (values, { setErrors }) => {
    try {
        const response = await updateCustomer(formValues.value.id, values);
        const index = customers.value.findIndex(
            (customer) => customer.id === response.data.id
        );
        customers.value[index] = response.data;
        $("#customerFormModal").modal("hide");
        toastr.success("Customer updated successfully");
    } catch (error) {
        if (error.response && error.response.data.errors) {
            setErrors(error.response.data.errors);
        }
        toastr.error("Error updating customer");
    }
};

// handle submit action for both adding and updating customer
const handleSubmit = (values, actions) => {
    if (editing.value) {
        updateCustomerAction(values, actions);
    } else {
        createCustomerAction(values, actions);
    }
};

// when page is mounted, get customers from the database
onMounted(() => {
    getCustomersAction();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            Customer Management
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <!-- Button trigger modal -->
            <button
                @click="addCustomer"
                type="button"
                class="btn btn-primary mb-2"
            >
                <i class="fa fa-plus-circle mr-1"></i>
                Add New Customer
            </button>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Registered Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <CustomerListItem
                                v-for="(customer, index) in customers"
                                :key="customer.id"
                                :customer="customer"
                                :index="index"
                                @edit-customer="editCustomer"
                            >
                            </CustomerListItem>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add / Edit Modal -->
    <div
        class="modal fade"
        id="customerFormModal"
        data-backdrop="static"
        tabindex="-1"
        role="dialog"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <span v-if="editing">Edit Customer</span>
                        <span v-else>Add New Customer</span>
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form
                    ref="form"
                    @submit="handleSubmit"
                    :validation-schema="
                        editing ? editCustomerSchema : createCustomerSchema
                    "
                    v-slot="{ errors }"
                    :initial-values="formValues"
                >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <Field
                                name="first_name"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': errors.first_name }"
                                id="firstName"
                                placeholder="Enter first name"
                            />
                            <span class="invalid-feedback">{{
                                errors.first_name
                            }}</span>
                        </div>

                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <Field
                                name="last_name"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': errors.last_name }"
                                id="lastName"
                                placeholder="Enter last name"
                            />
                            <span class="invalid-feedback">{{
                                errors.last_name
                            }}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <Field
                                name="email"
                                type="email"
                                class="form-control"
                                :class="{ 'is-invalid': errors.email }"
                                id="email"
                                placeholder="Enter email"
                            />
                            <span class="invalid-feedback">{{
                                errors.email
                            }}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone (+44)</label>
                            <Field
                                name="phone"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': errors.phone }"
                                id="phone"
                                placeholder="Enter phone number (e.g., +441234567890)"
                            />
                            <span class="invalid-feedback">{{
                                errors.phone
                            }}</span>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <Field
                                name="address"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': errors.address }"
                                id="address"
                                placeholder="Enter address"
                            />
                            <span class="invalid-feedback">{{
                                errors.address
                            }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>
