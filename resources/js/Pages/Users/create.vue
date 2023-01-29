<template>
    <AppLayout title="Users">

        <Head title="Create User" />
        <div class="bg-gray-300 p-2 rounded-lg mt-1">
            <Link :href="'/users'" class="btn btn-primary">Users</Link>
        </div>
        <div class="container lg:w-[800px] p-4 bg-gray-300 my-3 rounded-md">

            <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <InputLabel for="name" value="First name" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autofocus
                            autocomplete="name" />
                        <div />
                        <InputError class="mt-2" v-if="form.errors.has('name')" :message="form.errors.get('name')" />
                    </div>
                    <div>
                        <InputLabel for="Lastname" value="Last name" />
                        <TextInput id="Lastname" v-model="form.lastname" type="text" class="mt-1 block w-full" 
                            autocomplete="name" />
                        <InputError class="mt-2" v-if="form.errors.has('lastname')"
                            :message="form.errors.get('lastname')" />

                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                        <InputError class="mt-2" v-if="form.errors.has('email')" :message="form.errors.get('email')" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="mobile" value="Mobile" />
                        <TextInput id="mobile" v-model="form.mobile" type="text" class="mt-1 block w-full" />
                        <InputError class="mt-2" v-if="form.errors.has('mobile')"
                            :message="form.errors.get('mobile')" />
                    </div>
                    <div class="mt-5 w-full">
                        <InputLabel for="role" value="Role" />
                        <select name="role" id="" v-model="form.role"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="1">Manager</option>
                            <option value="2">Engineer</option>
                        </select>
                        <InputError class="mt-2" v-if="form.errors.has('role')" :message="form.errors.get('role')" />
                    </div>

                    <div class="mt-4" v-if="form.role == 1">
                        <InputLabel for="password" value="Password" />
                        <TextInput id="password" v-model="form.password" type="text" class="mt-1 block w-full"
                            autocomplete="new-password" />
                        <InputError class="mt-2" v-if="form.errors.has('password')"
                            :message="form.errors.get('password')" />

                    </div>

                    <!-- <div class="mt-4" v-if="form.role == 1">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="text"
                            class="mt-1 block w-full" autocomplete="new-password" />
                        <InputError class="mt-2" v-if="form.errors.has('password_confirmation')"
                            :message="form.errors.get('password_confirmation')" />

                    </div> -->
                </div>

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and
                                <a target="_blank" :href="route('policy.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add
                    </PrimaryButton>
                </div>
            </form>
        </div>


    </AppLayout>
</template>

<script >
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import Form from 'vform'
import { useToast } from "vue-toastification";
const toast = useToast();
export default {
    components: {
        Head, Link, AuthenticationCard, AuthenticationCardLogo, Checkbox, InputError, InputLabel, PrimaryButton, TextInput, AppLayout
    },
    data() {
        return {
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
                role: 1
            })
        }
    },
    methods: {
        submit() {
            this.form.post('/user-store')
                .then(res => {
                    if(res.data.status){
                    toast.success("User has been updated", {
                        timeout: 2000
                    }); 
                 }  
                })
        }
    }
}

</script>