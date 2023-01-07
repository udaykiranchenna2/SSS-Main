<template>
    <AppLayout title="Users">

        <Head title="Create User" />

        <div class="bg-gray-300 p-2 rounded-lg mt-1">
            <Link :href="'/create-users'" class="btn btn-primary">ADD</Link>
        </div>

           <div class="py-2 px-5">
            <Table   :data="users.data" :meta="users"
            :striped="true"
            :prevent-overlapping-requests="false"
            :input-debounce-ms="1000"
            :preserve-scroll="true"
            :resource="users">
           
            <template #cell(created_at)="{ item: user }">
                {{dateFormat1(user.created_at)}}
                </template>
            <template #cell(actions)="{ item: user }">
                <Link :href="'/user-customer'"  :data="{id:user.id}" class="btn btn-success text-white btn-sm mx-1">
                  Edit
                </Link>
                <Link :href="'/create-call'"  :data="{customer:user.customerid}" class="btn btn-danger text-white btn-sm mx-1">
                    Add Call
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
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
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
    },
    methods:{
        dateFormat1(date) {
                var options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                var dateval = new Date(date);

                return dateval.toLocaleDateString("en-US")
                // console.log(dateval.toLocaleDateString("en-US", options)); // Saturday, September 17, 2016
                // console.log(dateval.toLocaleDateString("hi-IN", options)); // शनिवार, 17 सितंबर 2016    
            },
    }
}

</script>