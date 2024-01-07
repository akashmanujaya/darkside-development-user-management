<script setup>
import { onMounted, reactive, ref } from "vue";
import axios from "axios";

const users = ref([]);
const form = reactive({
    name: "",
    email: "",
    password: "",
});

// get users from the database
const getUsers = () => {
    axios
        .get("/api/users")
        .then((response) => {
            users.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};

// create a user
const createUser = () => {
    axios.post("/api/users", form).then((response) => {
        users.value.unshift(response.data);
        $("#createUserModal").modal("hide");
        form.name = "";
        form.email = "";
        form.password = "";
    });
};

onMounted(() => {
    getUsers();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <!-- Button trigger modal -->
            <button
                type="button"
                class="btn btn-primary mb-2"
                data-toggle="modal"
                data-target="#createUserModal"
            >
                Add New User
            </button>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Role</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        class="modal fade"
        id="createUserModal"
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
                        Add New User
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
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                                id="name"
                                aria-describedby="nameHelp"
                                placeholder="Enter full name"
                            />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="form-control"
                                id="email"
                                aria-describedby="nameHelp"
                                placeholder="Enter full name"
                            />
                        </div>
                    </form>

                    <div class="form-group">
                        <label for="email">Password</label>
                        <input
                            v-model="form.password"
                            type="password"
                            class="form-control"
                            id="password"
                            aria-describedby="nameHelp"
                            placeholder="Enter password"
                        />
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
                    <button @click="createUser" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
