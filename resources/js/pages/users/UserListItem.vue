<script setup>
import { formatDate } from "../../helper.js";
import { ref , nextTick} from "vue";
import { useToastr } from "../../toastr.js";
import { defineProps, defineEmits } from "vue";

defineProps({
    user:Object,
    index: Number
});

const emit = defineEmits(['userDeleted', 'editUser']);
const userIdBeignDeleted = ref(null);
const toastr = useToastr();

// confirm user deletion
const confirmUserDeletion = (user) => {
    userIdBeignDeleted.value = user.id;
    nextTick(() => {
        $('#deleteUserModal').modal('show');
    });
};

// Delete the user
const deleteUser = () => {
    console.log(userIdBeignDeleted.value);
    axios
        .delete(`/api/users/${userIdBeignDeleted.value}`)
        .then(() => {
            $("#deleteUserModal").modal("hide");
            emit('userDeleted', userIdBeignDeleted.value);
            toastr.success('User deleted successfully');
        })
        .catch((error) => {
            console.log(error);
        });
};

const editUser = (user) => {
    emit('editUser', user);
};

</script>

<template>
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ formatDate(user.created_at) }}</td>
        <td>
            <a
                href="#"
                @click.prevent="editUser(user)"
                class="btn btn-sm btn-primary"
            >
                <i class="fas fa-edit"></i>
            </a>
            <a
                href="#"
                @click.prevent="confirmUserDeletion(user)"
                class="btn btn-sm btn-danger ml-2"
            >
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>

    <!-- Detele Modal -->
    <div
        class="modal fade"
        id="deleteUserModal"
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
                        <span>Delete User</span>
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
                    <h5>Are you sure you want to delete this user?</h5>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button @click.prevent="deleteUser" type="button" class="btn btn-primary">
                        Delete User
                    </button>
            </div>
        </div>
        </div>
    </div>
</template>
