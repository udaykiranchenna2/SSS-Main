<template>
    <AppLayout title="Users">

        <Head title="Create User" />
        <div class="bg-gray-300 p-2 rounded-lg mt-1 flex justify-between">
            <Link :href="'/open-calls'" class="btn btn-primary">Calls</Link>
            <InputLabel for="name" value="Search" />

            
        </div>
        <div class="container p-4 bg-gray-200 my-3 rounded-md h-[1000px]">
            <form @submit.prevent="submit">
               <div>
                <TabGroup>
                    <TabList class="flex justify-center">
                      <Tab as="template" v-slot="{ selected }">
                        <button :class="{ 'bg-blue-500 p-2 text-white  rounded-lg mx-2': selected, 'bg-white p-2 rounded-lg text-black': !selected }">
                            Call Register
                        </button>
                      </Tab>
                      <!-- <Tab as="template" v-slot="{ selected }">
                      <button :class="{ 'bg-blue-500 p-2 text-white  rounded-lg mx-2': selected, 'bg-white p-2 rounded-lg text-black': !selected }">
                        Call Details
                    </button>
                     </Tab> -->
                      
                    </TabList>
                    <TabPanels>
                      <TabPanel> 

                        <div>
                            <div class="text-2xl font-bold">
                                Customer Details
                            </div>
                            <div>
                                <div class="grid md:grid-cols-3 gap-2">
                                    <div class="mt-4">
                                        <InputLabel for="name" value="First name" />
                                        <TextInput id="firstname" v-model="form.firstname" type="text" class="mt-1 block w-full" autofocus
                                            autocomplete="firstname" />
                                        <div />
                                        <InputError class="mt-2" v-if="form.errors.has('firstname')" :message="form.errors.get('firstname')" />
                                    </div>
                                    <div class="mt-4">
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
                                        <InputLabel for="city" value="City" />
                                        <TextInput id="city" v-model="form.city" type="text" class="mt-1 block w-full" />
                                        <InputError class="mt-2" v-if="form.errors.has('city')"
                                            :message="form.errors.get('city')" />
                                    </div>
                                    
                                    <div class="mt-4" >
                                        <InputLabel for="address" value="Address" />
                                            <textarea   id="address" v-model="form.address" type="text"   class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                            </textarea>
                                        <InputError class="mt-2" v-if="form.errors.has('address')"
                                            :message="form.errors.get('address')" />
                
                                    </div>
                                    <div class="mt-4">
                                        <InputLabel for="area" value="Area" />
                                            <textarea   id="area" v-model="form.area" type="text"   class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                            </textarea>
                                        <InputError class="mt-2" v-if="form.errors.has('area')"
                                            :message="form.errors.get('area')" />
                
                                    </div>
                                    <div class="mt-5 w-full">
                                        <InputLabel for="state" value="State" />
                                        <select name="state" id="" v-model="form.state"
                                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                            <option value="Gujarat">Gujarat</option>
                                        </select>
                                        <InputError class="mt-2" v-if="form.errors.has('state')" :message="form.errors.get('state')" />
                                    </div>
                                    <div class="mt-5 w-full">
                                        <InputLabel for="country" value="Country" />
                                        <select name="country" id="" v-model="form.country"
                                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                            <option value="India">India</option>
                                        </select>
                                        <InputError class="mt-2" v-if="form.errors.has('country')" :message="form.errors.get('country')" />
                                    </div>
                                    <div class="mt-4">
                                        <InputLabel for="pincode" value="Pincode" />
                                        <TextInput id="pincode" v-model="form.pincode" type="text" class="mt-1 block w-full" />
                                        <InputError class="mt-2" v-if="form.errors.has('pincode')"
                                            :message="form.errors.get('pincode')" />
                                    </div>
                                    <div class="mt-4">
                                        <InputLabel for="mobile1" value="Mobile1" />
                                        <TextInput id="mobile1" v-model="form.mobile1" type="text" class="mt-1 block w-full" />
                                        <InputError class="mt-2" v-if="form.errors.has('mobile1')"
                                            :message="form.errors.get('mobile1')" />
                                    </div>
                                    <div class="mt-4">
                                        <InputLabel for="mobile2" value="Mobile2" />
                                        <TextInput id="mobile2" v-model="form.mobile2" type="text" class="mt-1 block w-full" />
                                        <InputError class="mt-2" v-if="form.errors.has('mobile2')"
                                            :message="form.errors.get('mobile2')" />
                                    </div>
                                   
                                </div>
                            </div>
                             <div class="text-2xl font-bold mt-10" >
                                Call Details
                            </div>
                            <div>
                                <div class="grid md:grid-cols-3 gap-2">
                                    <div class="mt-5 w-full">
                                        <InputLabel for="calltype" value="Call Type" />
                                        <select name="calltype" id="" v-model="form.calltype"
                                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                            <option value="firstdemoinstalation">First demo and installation</option>
                                            <option value="complaintcall">Complaint Call</option>
                                            <option value="reinstalation">Re-instalation</option>
                                        </select>
                                        <InputError class="mt-2" v-if="form.errors.has('calltype')" :message="form.errors.get('calltype')" />
                                    </div>
                                    <div class="mt-5 w-full">
                                        <InputLabel for="brandname" value="Brand" />
                                        <Multiselect
                                        v-model="form.brandname"
                                        :options="brands"
                                        />
                                        <InputError class="mt-2" v-if="form.errors.has('brandname')" :message="form.errors.get('brandname')" />
                                    </div>

                                    <div class="mt-4" v-if="form.brandname == 'Other'">
                                        <InputLabel for="brand" value="Add Brand" />
                                        <TextInput id="extrabrand" v-model="form.extrabrand" type="text" class="mt-1 block w-full" autofocus
                                            autocomplete="extrabrand" />
                                        <div />
                                        <InputError class="mt-2" v-if="form.errors.has('extrabrand')" :message="form.errors.get('extrabrand')" />
                                    </div>
                                    <div class="mt-5 w-full">
                                        <InputLabel for="productcategory" value="Product Category" />
                                        <Multiselect
                                        v-model="form.productcategory"
                                        :options="pcats"
                                        />
                                        <InputError class="mt-2" v-if="form.errors.has('productcategory')" :message="form.errors.get('productcategory')" />
                                    </div>

                                    <div class="mt-4" v-if="form.productcategory == 'Other'">
                                        <InputLabel for="productcategory" value="Add Product Category" />
                                        <TextInput id="extraproductcategory" v-model="form.extraproductcategory" type="text" class="mt-1 block w-full" autofocus
                                            autocomplete="extraproductcategory" />
                                        <div />
                                        <InputError class="mt-2" v-if="form.errors.has('extraproductcategory')" :message="form.errors.get('extraproductcategory')" />
                                    </div>
                                    
                                    <div class="mt-4">
                                        <InputLabel for="description" value="Description" />
                                            <textarea   id="description" v-model="form.description" type="text"   class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                            </textarea>
                                        <InputError class="mt-2" v-if="form.errors.has('description')"
                                            :message="form.errors.get('description')" />
                                    </div>
                                    <div class="mt-5">
                                        <InputLabel for="VisitDateTime" value="Visit Date Time" />
                                        <Datepicker v-model="form.visitdate"></Datepicker>
                                        <div />
                                        <InputError class="mt-2" v-if="form.errors.has('visitdate')"
                                            :message="form.errors.get('visitdate')" />
                                    </div>
                                     <div class="mt-5 col-span-3">
                                        <InputLabel for="productcategory" value="Add files" />
                                        <TextInput id="files" type="file" class="mt-1 block w-full" name="files" multiple
                                        v-on:change="onFileChange"/>
                                        <div />
                                        <InputError class="mt-2" v-if="form.errors.has('extraproductcategory')" :message="form.errors.get('extraproductcategory')" />
                                    </div>
                                </div>
                            </div>
                           </div>
                      </TabPanel>
                    </TabPanels>
                    </TabGroup>
               
             
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
  import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
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

import Multiselect from '@vueform/multiselect';
import Datepicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
    import { useToast } from "vue-toastification";
const toast = useToast();
export default {
    props:{
        brands:Object,
        pcats:Object,
        customer:Object,
    },
    components: {
        Head, Link, AuthenticationCard, AuthenticationCardLogo, Checkbox, InputError, InputLabel, PrimaryButton, 
        TextInput, AppLayout,TabGroup, TabList, Tab, TabPanels, TabPanel,Multiselect,Datepicker
    },
    data() {
        return {
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
                role: 1,
                files :[],
            }),
            pcatsList:this.pcats,
            brandsList:this.brands,
        }
    },
    methods: {
        submit() {
            this.form.post('/create-store')
                .then(res => {
                    if(res.data.status){
                        console.log(res.data);
                    toast.success("call has been updated", {
                        timeout: 2000
                    }); 
                    this.$inertia.get('/open-calls');
                 }  
                })
        },
        onFileChange(e) {
                    
                    this.form.files = e.target.files;
},
        bindingCustomer()
        {
            if(this.customer)
            {
                this.form.customerid = this.customer.customerid;
                this.form.firstname = this.customer.firstname;
                this.form.lastname = this.customer.lastname;
                this.form.email = this.customer.email;
                this.form.address = this.customer.address;
                this.form.area = this.customer.area;
                this.form.city = this.customer.city;
                this.form.state = this.customer.state;
                this.form.country = this.customer.country;
                this.form.pincode = this.customer.pincode;
                this.form.mobile1 = this.customer.mobile1;
                this.form.mobile2 = this.customer.mobile2;
            }
        }
    },
    mounted()
    {
        console.log(this.brandsList);

        this.brandsList["Other"] = "Other";
        this.pcatsList["Other"] = "Other";
        this.bindingCustomer();
      
    }
}


</script>
<style src="@vueform/multiselect/themes/default.css"></style>