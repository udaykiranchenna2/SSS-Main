<template>
    <AppLayout title="Users">

        <Head title="Calls" />

        <div class="bg-gray-300 p-2 rounded-lg mt-1">
            <Link :href="'/create-call'" class="btn btn-primary">Create New Call</Link>
        </div>

        <div class="py-2">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="py-3 pl-2">

                    </div>

                    <div class="p-1.5 w-full inline-block align-middle">
                        <div class="overflow-hidden border rounded-lg overflow-x-auto w-full">
                            <table
                                class="mx-auto  w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                                <thead class="bg-gray-600">
                                    <tr class="text-left">
                                        <!-- <th scope="col" class="py-3 pl-4">
                                            <div class="flex items-center h-5">
                                                <input id="checkbox-all" type="checkbox"
                                                    class="text-blue-600 border-gray-200 rounded focus:ring-blue-500" />
                                                <label for="checkbox" class="sr-only">
                                                    Checkbox
                                                </label>
                                            </div>
                                        </th> -->
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            Req No.
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            Req Date
                                        </th>
                                        <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                        Visit date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            Added by
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                            Call Age
                                        </th>
                                      
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                            Cust Code
                                        </th>
                                        <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                        Cust name
                                        </th>
                                        <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                        Call type
                                        </th>
                                        
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                            Service Engg Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-bold  text-white uppercase">
                                            Allocation
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-bold  text-white uppercase">
                                            Update
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-bold  text-white uppercase">
                                            View
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr v-for="(item, index) in calls.data" :key="index" class="text-left">
                                        <!-- <td class="py-3 pl-4">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox"
                                                    class="text-blue-600 border-gray-200 rounded focus:ring-blue-500" />
                                                <label for="checkbox" class="sr-only">
                                                    Checkbox
                                                </label>
                                            </div>
                                        </td> -->
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ item.requestno }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ dateFormat1(item.created_at) }}
                                        </td>
                                        <td
                                        class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                        <span v-if="item.visitdate">{{ dateFormat1(item.visitdate) }}</span>
                                    </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{item.user.name }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ dateDiff(item.created_at) }}
                                        </td>
                                        <!-- <td class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                           {{item.id}}
                                        </td> -->
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ item.customer.customerid }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ item.customer.firstname }}
                                            {{ item.customer.lastname }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ calltype(item.calltype) }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <span v-if="item.assignees.length>0">
                                                {{assignedUser(item.assignees[0].userid) }}
                                            </span>
                                            <span v-else>
                                                -
                                            </span>
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <span v-if="item.statuses && item.statuses.length>0">
                                                {{item.statuses[0].status }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-3 py-4 text-center text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <i class="cursor-pointer fa-solid fa-user-plus"
                                                @click="openAllocation(item)"></i>
                                        </td>
                                        <td
                                            class="px-3 py-4 text-center text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <i class="cursor-pointer fa-solid fa-pen" @click="openEditModal(item)"></i>
                                        </td>
                                        <td
                                            class="px-3 py-4 text-center text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <i class="cursor-pointer fa-solid fa-eye" @click="openViewModal(item)"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                                                                                            
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal" class="relative z-10">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                        enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                        leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center p-4 text-center">
                            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                                <DialogPanel
                                    class="w-full max-w-3xl transform overflow-hidden rounded-2xl bg-white pb-6 text-left align-middle shadow-xl transition-all">
                                    <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">

                                        <div class="flex justify-between bg-gray-300  py-2  px-6">
                                            <div>
                                                Allocate to Engineer
                                            </div>
                                            <div @click="closeModal" class="cursor-pointer">
                                                <i class="fa-solid fa-x"></i>
                                            </div>
                                        </div>
                                    </DialogTitle>
                                    <div class="mt-2 px-6">

                                        <div class=" h-80"
                                            v-if="selectedAllocation.assignees &&selectedAllocation.assignees.length<=0">
                                            <div class="grid md:grid-cols-3 gap-2  ">

                                                <div class="mt-5 w-full">
                                                    <InputLabel for="Engineers" value="Engineers" />
                                                    <Multiselect v-model="form.engineer" :options="engineers"
                                                        :canClear="false" />
                                                    <InputError class="mt-2" v-if="form.errors.has('engineer')"
                                                        :message="form.errors.get('engineer')" />
                                                </div>

                                                <div class="mt-5">
                                                    <InputLabel for="VisitDateTime" value="Visit Date Time" />
                                                    <Datepicker v-model="form.visitdate"></Datepicker>
                                                    <div />
                                                    <InputError class="mt-2" v-if="form.errors.has('visitdate')"
                                                        :message="form.errors.get('visitdate')" />
                                                </div>



                                            </div>
                                            <div>
                                                <PrimaryButton class="mt-5" @click="allocate()">Re Allocate
                                                </PrimaryButton>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class=" h-80" v-else>
                                            <div class="grid md:grid-cols-3 gap-2  ">


                                                <div class="mt-5 w-full">
                                                    <InputLabel for="Engineers" value="Engineer" />
                                                    {{assignedUser(selectedAllocation.assignees[0].userid) }}
                                                </div>
                                                <div class="mt-5 w-full">
                                                    <InputLabel for="Engineers" value="Engineers" />
                                                    <Multiselect v-model="form.engineer" :options="engineers"
                                                        :canClear="false" />
                                                    <InputError class="mt-2" v-if="form.errors.has('engineer')"
                                                        :message="form.errors.get('engineer')" />
                                                </div>

                                                <div class="mt-5">
                                                    <InputLabel for="VisitDateTime" value="Visit Date Time" />
                                                    <Datepicker v-model="form.visitdate"></Datepicker>
                                                    <div />
                                                    <InputError class="mt-2" v-if="form.errors.has('visitdate')"
                                                        :message="form.errors.get('visitdate')" />
                                                </div>

                                            </div>
                                            <div>
                                                <PrimaryButton class="mt-5" @click="allocate()">Re Allocate
                                                </PrimaryButton>
                                            </div>
                                        </div>
                                    </div>


                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
          
            <TransitionRoot appear :show="openView" as="template">
                <Dialog as="div" @close="closeViewModal" class="relative z-10">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                        enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                        leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center p-4 text-center">
                            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                                <DialogPanel
                                    class="w-full  transform overflow-hidden rounded-2xl bg-white pb-6 text-left align-middle shadow-xl transition-all">
                                    <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">

                                        <div class="flex justify-between bg-gray-300  py-2  px-6">
                                            <div>
                                                View Call
                                            </div>
                                            <div @click="closeViewModal" class="cursor-pointer">
                                                <i class="fa-solid fa-x"></i>
                                            </div>
                                        </div>
                                    </DialogTitle>
                                    <div class="mt-2 px-6">
                                        <form @submit.prevent="updateCustomer">
                                            <div>
                                                <TabGroup>
                                                    <TabList class="flex justify-center">
                                                        <Tab as="template" v-slot="{ selected }">
                                                            <button
                                                                :class="{ 'bg-blue-500 p-2 text-white  rounded-lg mx-2': selected, 'bg-white p-2 rounded-lg text-black': !selected }">
                                                                Call Details And Update
                                                            </button>
                                                        </Tab>

                                                    </TabList>
                                                    <TabPanels>
                                                        <TabPanel>
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
                                                                                class="mt-1 block w-full p-1" autofocus
                                                                                autocomplete="firstname">
                                                                                {{ this.opendedItem.customer.customerid }}
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
                                                                <div class="border border-gray-400 rounded-md  p-4 ">

                                                                    <div class="grid lg:grid-cols-2  gap-2">
                                                                        <div class="flex p-1">
                                                                            <label for="" class="w-32 font-bold">Product
                                                                                category :</label>
                                                                            <div>{{ this.opendedItem.productcategory }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex p-1">
                                                                            <label for=""
                                                                                class="w-32 font-bold">Brand:</label>
                                                                            <div>{{ this.opendedItem.brand }}</div>
                                                                        </div>
                                                                        <div class="flex p-1">
                                                                            <label for="" class="w-32 font-bold">Service
                                                                                Call Description:</label>
                                                                            <div>{{ this.opendedItem.description }}
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </TabPanel>
                                                    </TabPanels>
                                                </TabGroup>


                                            </div>




                                        </form>
                                    </div>


                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>

    </AppLayout>
</template>

<script>
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
    TabPanel
    } from '@headlessui/vue'
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue'
    import Multiselect from '@vueform/multiselect'
    import Datepicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/inertia-vue3';

    import AppLayout from '@/Layouts/AppLayout.vue';

    import Form from 'vform'
import axios from 'axios';
    export default {
        components: {
            Head,
            Link,
            AppLayout,
            TransitionRoot,
            TransitionChild,
            Dialog,
            DialogPanel,
            DialogTitle,
            InputError,
            InputLabel,
            PrimaryButton,
            TextInput,
            Multiselect,
            Datepicker,
            TabGroup,
            TabList,
            Tab,
            TabPanels,
            TabPanel

        },
        props: {
            calls: Object,
            engineers: Object,
            assignedusers: Object,
            brands: Object,
            pcats: Object,
        },
        data() {
            return {
                loading: false,
                form: new Form({

                }),
                form2: new Form({

                }),
                form3: new Form({

                }),
                isOpen: false,
                openEdit: false,
                openView: false,
                selectedAllocation: [],
                opendedItem: [],
                pcatsList:this.pcats,
                brandsList:this.brands,

            }
        },
        mounted()
        {
        this.brandsList["Other"] = "Other";
        this.pcatsList["Other"] = "Other";
        },
        methods: {
            allocate() {
                this.form.callid = this.selectedAllocation.requestno;
                this.form.post('allocate-engineer')
                    .then(res => {
                        this.form.clear();
                        this.selectedAllocation = [];
                    });
                this.closeModal();

                this.$inertia.get('open-calls');

            },

            openAllocation(item) {
                this.selectedAllocation = item;
                this.isOpen = true;
            },
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
            dateDiff(date) {
                const date1 = new Date(date);
                const date2 = new Date();
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                diffTime + " milliseconds";
                return diffDays;
            },
            closeModal() {
                this.isOpen = false;
            },
            openEditModal(item) {
            this.$inertia.get('/edit-call',{callid: item.requestno});
               
            },
            closeEditmodal() {
                this.openEdit = false;
            },
            openViewModal(item) {
                this.opendedItem = item;

                this.form3.id = this.opendedItem.customer.id;
                this.form3.customerid = this.opendedItem.customer.customerid;
                this.form3.firstname = this.opendedItem.customer.firstname;
                this.form3.lastname = this.opendedItem.customer.lastname;
                this.form3.email = this.opendedItem.customer.email;
                this.form3.city = this.opendedItem.customer.city;
                this.form3.state = this.opendedItem.customer.state;
                this.form3.country = this.opendedItem.customer.country;
                this.form3.address = this.opendedItem.customer.address;
                this.form3.area = this.opendedItem.customer.area;
                this.form3.state = this.opendedItem.customer.state;
                this.form3.pincode = this.opendedItem.customer.pincode;
                this.form3.mobile1 = this.opendedItem.customer.mobile1;
                this.form3.mobile2 = this.opendedItem.customer.mobile2;
                this.openView = true;
            },
            closeViewModal() {
                this.openView = false;
            },
            assignedUser(userid) {
                let name = '';
                this.assignedusers.forEach(element => {
                    if (element.id == userid) {
                        name = element.name;
                    }

                });
                return name;
            },
            updateCustomer(){
                this.form3.post('update-customer')
                .then(res => {
                    if(res.data.status)
                    {
                        this.$inertia.get('/open-calls');
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


        }
    }

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
