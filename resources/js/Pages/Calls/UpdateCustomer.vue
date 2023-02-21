<template>
    <div >
        <div class="mt-2 px-6">
            <form @submit.prevent="updateCustomer">
                <div>
                    <div>
                        <div class="text-2xl font-bold">
                            Customer Details
                        </div>
                        <div>
                            <div class="grid md:grid-cols-4 gap-2">
                                <div class="mt-4">
                                    <InputLabel for="name"
                                        value="Customer Id" />
                                    <div id="firstname" type="text"
                                        class="p-1  mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm bg-gray-400" autofocus
                                        autocomplete="firstname">
                                        {{ this.item.customer.customerid }}
                                    </div>
                                    <div />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('firstname')"
                                        :message="form3.errors.get('firstname')" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="name" value="First name" />
                                    <TextInput id="firstname"
                                        v-model="form3.firstname" type="text"
                                        class="mt-1 block w-full p-1 p-1"
                                        autofocus autocomplete="firstname" />
                                    <div />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('firstname')"
                                        :message="form3.errors.get('firstname')" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="Lastname"
                                        value="Last name" />
                                    <TextInput id="Lastname"
                                        v-model="form3.lastname" type="text"
                                        class="mt-1 block w-full p-1"
                                        autocomplete="name" />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('lastname')"
                                        :message="form3.errors.get('lastname')" />

                                </div>

                                <div class="mt-4">
                                    <InputLabel for="email" value="Email" />
                                    <TextInput id="email" v-model="form3.email"
                                        type="email"
                                        class="mt-1 block w-full p-1" />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('email')"
                                        :message="form3.errors.get('email')" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="city" value="City" />
                                    <TextInput id="city" v-model="form3.city"
                                        type="text"
                                        class="mt-1 block w-full p-1" />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('city')"
                                        :message="form3.errors.get('city')" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="address" value="Address" />
                                    <textarea id="address"
                                        v-model="form3.address" type="text"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                 </textarea>
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('address')"
                                        :message="form3.errors.get('address')" />

                                </div>
                                <div class="mt-4">
                                    <InputLabel for="area" value="Area" />
                                    <textarea id="area" v-model="form3.area"
                                        type="text"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                 </textarea>
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('area')"
                                        :message="form3.errors.get('area')" />

                                </div>
                                <div class="mt-5 w-full">
                                    <InputLabel for="state" value="State" />
                                    <select name="state" id=""
                                        v-model="form3.state"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                        <option value="Gujarat">Gujarat</option>
                                    </select>
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('state')"
                                        :message="form3.errors.get('state')" />
                                </div>
                                <div class="mt-5 w-full">
                                    <InputLabel for="country" value="Country" />
                                    <select name="country" id=""
                                        v-model="form3.country"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                        <option value="India">India</option>
                                    </select>
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('country')"
                                        :message="form3.errors.get('country')" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="pincode" value="Pincode" />
                                    <TextInput id="pincode"
                                        v-model="form3.pincode" type="text"
                                        class="mt-1 block w-full p-1" />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('pincode')"
                                        :message="form3.errors.get('pincode')" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="mobile1" value="Mobile1" />
                                    <TextInput id="mobile1"
                                        v-model="form3.mobile1" type="text"
                                        class="mt-1 block w-full p-1" />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('mobile1')"
                                        :message="form3.errors.get('mobile1')" />
                                </div>
                                <div class="mt-4">
                                    <InputLabel for="mobile2" value="Mobile2" />
                                    <TextInput id="mobile2"
                                        v-model="form3.mobile2" type="text"
                                        class="mt-1 block w-full p-1" />
                                    <InputError class="mt-2"
                                        v-if="form3.errors.has('mobile2')"
                                        :message="form3.errors.get('mobile2')" />
                                </div>

                            </div>
                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton class="ml-4"
                                    :class="{ 'opacity-25': form3.processing }"
                                    :disabled="form3.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </div>
                        <div class="text-2xl font-bold mt-10">
                            Call Details
                        </div>
                       
                    </div>

                </div>




            </form>
        </div>
    </div>
</template>
<script>

import Form from 'vform'
import axios from 'axios';
import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue'
    import Multiselect from '@vueform/multiselect'
    import Datepicker from '@vuepic/vue-datepicker';
    import { useToast } from "vue-toastification";
const toast = useToast();
    import {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
    } from '@headlessui/vue'
export default {
    components:{
        InputError,
            InputLabel,
            PrimaryButton,
            TextInput,
            Multiselect,
            Datepicker,
            
    },
    props: {
            item:Object,
            engineers: Object,
            assignedusers: Object,
            brands: Object,
            pcats: Object,
    },
    data() {
        return {
            form3: new Form({

}),
        }
    },
    methods: {
        updateCustomer(){
                this.form3.post('update-customer')
                .then(res => {
                    if(res.data.status)
                    {
                        toast.success("customer has been updated", {
                        timeout: 2000
                    }); 
                    }
                })
            },
            calltype(type){
                if(type == 'firstdemoinstalation')
                {
                    return 'First demo and installation';
                }
                if(type == 'complaintcall')
                {
                    return 'Complaint Call';
                }
                if(type == 'reinstalation')
                {
                    return 'Re-instalation';
                }
            }
    },
    computed:
    {

    },

    mounted(){
               this.form3.id = this.item.customer.id;
                this.form3.customerid = this.item.customer.customerid;
                this.form3.firstname = this.item.customer.firstname;
                this.form3.lastname = this.item.customer.lastname;
                this.form3.email = this.item.customer.email;
                this.form3.city = this.item.customer.city;
                this.form3.state = this.item.customer.state;
                this.form3.country = this.item.customer.country;
                this.form3.address = this.item.customer.address;
                this.form3.area = this.item.customer.area;
                this.form3.state = this.item.customer.state;
                this.form3.pincode = this.item.customer.pincode;
                this.form3.mobile1 = this.item.customer.mobile1;
                this.form3.mobile2 = this.item.customer.mobile2;
    }

}
</script>