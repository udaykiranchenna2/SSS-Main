<template>
    <AppLayout title="Users">

        <Head title="Create User" />

        <div class="bg-gray-300 p-2 rounded-lg mt-1">
            <Link :href="'/create-users'" class="btn btn-primary">ADD</Link>
        </div>

           <div class="py-2">
            <Table   :data="users.data" :meta="users"
            :striped="true"
            :prevent-overlapping-requests="false"
            :input-debounce-ms="1000"
            :preserve-scroll="true"
            :resource="users">
            <template #cell(role)="{ item: user }">
               <div v-if="user.role==1">
                Manager
               </div>
               <div v-if="user.role==2">
                Engineer
               </div>
              </template>
              <template #cell(lastname)="{ item: user }">
               {{user.lastname}}
               </template>
            <template #cell(actions)="{ item: user }">
                <Link :href="'/user-edit'"  :data="{id:user.id}" class="btn btn-success text-white btn-sm mx-1">
                  Edit
                </Link>
                <!-- <button @click="deleteuser(user.id)" class="btn btn-danger text-white btn-sm mx-1">
                    Delete
                  </button> -->
              </template>
        </Table>
           </div>

    </AppLayout>
</template>

<script >
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
export default {
    components: {
        Head, Link, PrimaryButton, AppLayout,Table
    },
    props:{
        users:Object
    },
    data() {
        return {
            form: useForm({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            }),
        }
    }
}

</script>