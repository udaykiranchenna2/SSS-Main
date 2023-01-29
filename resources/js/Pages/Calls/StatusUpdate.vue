<template>
    <div class="p-1.5 w-full inline-block align-middle">
        <div class="overflow-hidden border rounded-lg overflow-x-auto w-full">
            <div class="w-full">
                <div class="mx-auto w-full rounded-2xl bg-white p-2">

                    <Disclosure as="div" class="mb-2" v-slot="{ open }">
                        <DisclosureButton
                            class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75">
                            <span>Update Status</span>
                            <ChevronUpIcon :class="open ? 'rotate-180 transform' : ''"
                                class="h-5 w-5 text-purple-500" />
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="border rounded-md border-gray-300 p-3">
                                    <div class="grid md:grid-cols-2 gap-2">
                                        <div class=" col-span-2 p-2 bg-gray-300 rounded-sm">
                                            Service call update
                                        </div>
                                        <div class="mt-4">
                                            <InputLabel for="name" value="Visited Date" />
                                            <Datepicker id="" v-model="form.visitdate" class="mt-1 block w-full " />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('visitdate')"
                                                :message="form.errors.get('visitdate')" />
                                        </div>
                                        <div class="mt-4">
                                            <InputLabel for="name" value="Service call status" />
                                            <Multiselect id="Status" v-model="form.status" type="text"
                                                :options="generalStatus" class="mt-1 block w-full p-1" autofocus
                                                autocomplete="status" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('status')"
                                                :message="form.errors.get('status')" />
                                        </div>
                                        <div class="mt-4" v-if="form.status == 'Peding From Customer Side'">
                                            <InputLabel for="name" value="Service call sub status" />
                                            <TextInput type="text" id="" v-model="form.sub_status"
                                            class="mt-1 block w-full p-2" autofocus autocomplete="amount" />
                                            <InputError class="mt-2" v-if="form.errors.has('sub_status')"
                                                :message="form.errors.get('sub_status')" />
                                        </div>
                                        <div class="mt-4" v-if="form.status == 'Work Shop Repair'">
                                            <InputLabel for="name" value="Service call sub status" />
                                            <Multiselect id="sub_status" v-model="form.sub_status" type="text"
                                                :options="subStatuses" class="mt-1 block w-full p-1" autofocus
                                                autocomplete="sub_status" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('sub_status')"
                                                :message="form.errors.get('sub_status')" />
                                        </div>

                                        <div class="mt-4 col-span-2">
                                            <InputLabel for="remark" value="Remark" />
                                            <textarea id="remark" v-model="form.remark" type="text"
                                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                       </textarea>
                                            <InputError class="mt-2" v-if="form.errors.has('remark')"
                                                :message="form.errors.get('remark')" />

                                        </div>
                                        <div class="mt-5" v-if="form.status == 'Call Close'">
                                            <InputLabel for="name" value="Payment Status" />
                                            <Multiselect id="paymentStatus" v-model="form.paymentStatus" type="text"
                                                :options="paymentStatuses" class="mt-1 block w-full p-0" autofocus
                                                autocomplete="paymentStatus" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('status')"
                                                :message="form.errors.get('status')" />
                                        </div>
                                        <div class="mt-4" v-if="form.status == 'Call Close'">
                                            <InputLabel for="name" value="Total Amount" />
                                            <TextInput type="number" id="paymentStatus" v-model="form.amount"
                                                class="mt-1 block w-full p-2" autofocus autocomplete="amount" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('amount')"
                                                :message="form.errors.get('amount')" />
                                        </div>
                                        <div class="mt-4" v-if="form.status == 'Call Close'">
                                            <InputLabel for="name" value="Paid Amount" />
                                            <TextInput type="number" id="paid" v-model="form.paid"
                                                class="mt-1 block w-full p-2" autofocus autocomplete="paid" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('status')"
                                                :message="form.errors.get('paid')" />
                                        </div>
                                        <div class="mt-4" v-if="form.status == 'Call Close'">
                                            <InputLabel for="name" value="Due Amount" />
                                            <TextInput type="number" id="dueAmount" disabled v-model="dueAmount"
                                                class="mt-1 block w-full p-2" autofocus autocomplete="dueAmount" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('dueAmount')"
                                                :message="form.errors.get('dueAmount')" />
                                        </div>
                                        <div class="mt-4" v-if="form.status == 'Call Close'">
                                            <InputLabel for="name" value="Payment Method" />
                                            <Multiselect id="paymentmethod" v-model="form.mode" type="text"
                                                :options="paymentMethods" class="mt-1 block w-full p-1" autofocus
                                                autocomplete="paymentmethod" />
                                            <div />
                                            <InputError class="mt-2" v-if="form.errors.has('sub_status')"
                                                :message="form.errors.get('sub_status')" />
                                        </div>
                                        <div class="mt-4 col-span-2">
                                            <InputLabel for="name" value="Attachments" />
                                            <input multiple ref="uploadAttachments"
                                                class="block w-full text-sm p-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                                                 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                id="file_input" type="file" v-on:change="handleFileUpload()" />

                                            <InputError class="mt-2" v-if="form.errors.has('attachments')"
                                                :message="form.errors.get('attachments')" />
                                        </div>




                                    </div>
                                    <div class="flex items-center justify-end mt-4">

                                        <PrimaryButton @click="addNewStatus" class="ml-4"
                                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Update
                                        </PrimaryButton>
                                    </div>
                                </div>
                                <div class="border rounded-md border-gray-300 p-3">
                                    <div class="grid md:grid-cols-2 gap-2">
                                        <div class=" col-span-2 p-2 bg-gray-300 rounded-sm">
                                            Next Visit update
                                        </div>
                                        <div class="mt-4">
                                            <InputLabel for="name" value="Visit Date" />
                                            <Datepicker id="" v-model="form2.visitdate" class="mt-1 block w-full " />
                                            <div />
                                            <InputError class="mt-2" v-if="form2.errors.has('visitdate')"
                                                :message="form2.errors.get('visitdate')" />
                                        </div>


                                        <div class="mt-4 col-span-2">
                                            <InputLabel for="description" value="Description" />
                                            <textarea id="description" v-model="form2.description" type="text"
                                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
                                       </textarea>
                                            <InputError class="mt-2" v-if="form2.errors.has('description')"
                                                :message="form2.errors.get('description')" />

                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">

                                        <PrimaryButton @click="updateNextVisit" class="ml-4"
                                            :class="{ 'opacity-25': form.processing }" :disabled="form2.processing">
                                            Update
                                        </PrimaryButton>
                                    </div>
                                </div>
                            </div>
                        </DisclosurePanel>
                    </Disclosure>
                    <Disclosure v-slot="{ open }">
                        <DisclosureButton
                            class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75">
                            <span>View Call Timeline</span>
                            <ChevronUpIcon :class="open ? 'rotate-180 transform' : ''"
                                class="h-5 w-5 text-purple-500" />
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
                            <table
                                class="mx-auto  w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                                <thead class="bg-gray-600">
                                    <tr class="text-left">
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                            Sub status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase w-[400px]">
                                            remark
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            Visited date
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-left text-white uppercase">
                                            Created On
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold  text-white uppercase">
                                            details
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr v-for="(item, index) in statuses" :key="index" class="text-left">

                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ index+1 }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ item.status }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap w-[200px]">
                                            {{item.sub_status }}
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-normal w-[400px]">
                                            {{ item.remark }}
                                        </td>

                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <span v-if="item.visitdate">{{ dateFormat1(item.visitdate) }}</span>
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                            <span v-if="item.created_at">{{ dateFormat1(item.created_at) }}</span>
                                        </td>
                                        <td
                                            class="px-3 py-4 text-left text-sm font-medium text-gray-800 whitespace-nowrap">
                                           View
                                        </td>





                                    </tr>
                                </tbody>
                            </table>
                        </DisclosurePanel>
                    </Disclosure>
                </div>
            </div>

        </div>
    </div>
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
        TabPanel,
        Disclosure,
        DisclosureButton,
        DisclosurePanel
    } from '@headlessui/vue'
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue'
    import Multiselect from '@vueform/multiselect'
    import Datepicker from '@vuepic/vue-datepicker';
    import UpdateCustomer from './UpdateCustomer.vue';
    import UpdateCallDetails from './UpdateCallDetails.vue';

    import '@vuepic/vue-datepicker/dist/main.css'
    import {
        Head,
        Link,
        useForm,router
    } from '@inertiajs/vue3';

    import AppLayout from '@/Layouts/AppLayout.vue';

    import Form from 'vform'
    import axios from 'axios';
    import {
        ChevronUpIcon
    } from '@heroicons/vue/20/solid'


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
            TabPanel,
            UpdateCustomer,
            UpdateCallDetails,
            Disclosure,
            DisclosureButton,
            DisclosurePanel,
            ChevronUpIcon

        },
        props: {
            item: Object,
            engineers: Object,
            assignedusers: Object,
            brands: Object,
            pcats: Object,
            statuses: Object
        },
        data() {
            return {

                loading: false,
                form: new Form({
                    visitdate: '',
                    status: '',
                    sub_status: '',
                    paymentStatus: 'Due',
                    remark: '',
                    requestno: this.item.requestno
                }),
                form2: new Form({

                }),


                isOpen: false,
                openEdit: false,
                openView: false,
                selectedAllocation: [],
                opendedItem: [],
                pcatsList: this.pcats,
                brandsList: this.brands,
                generalStatus: {
                    'Part Pending': 'Part Pending',
                    'Visit Done': 'Visit Done',
                    'Peding From Customer Side': 'Peding From Customer Side',
                    'Commercial Pending': 'Commercial Pending',
                    'Technical Assist': 'Technical Assist',
                    'Service On Hold Due To lockdown': 'Service On Hold Due To lockdown',
                    'Part Replaced': 'Part Replaced',
                    'Work Shop Repair': 'Work Shop Repair',
                    'Call Close': 'Call Close',
                    'Re-open': 'Re-open',

                },
                subStatuses: {
                    'Set Call Back Done': 'Set Call Back Done',
                    'Set Delivered': 'Set Delivered',
                },
                paymentStatuses: {
                    'Due': 'Due',
                    'Paid': 'Paid',
                },
                paymentMethods: {
                    'Cash': 'Cash',
                    'Gpay': 'Gpay',
                    'Phone pe': 'Phone pe',
                    'Other UPI': 'Other UPI',
                    'Cheque': 'Cheque',
                }

            }
        },
        mounted() {
            this.brandsList["Other"] = "Other";
            this.pcatsList["Other"] = "Other";
        },
        computed: {
            dueAmount() {
                if (this.form.totalAmount != '' && this.form.totalAmount != null && this.form.paidAmount && this.form
                    .paidAmount != null && this.form.totalAmount >= this.form.paidAmount) {
                    let num = 0.00;

                    num = this.form.totalAmount - this.form.paidAmount;

                    return num.toString();

                } else {
                    return '';
                }
            }
        },
        methods: {


            dateFormat1(date) {
                var options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                var today = new Date(date);
                const yyyy = today.getFullYear();
                let mm = today.getMonth() + 1; // Months start at 0!
                let dd = today.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                return dd + '/' + mm + '/' + yyyy;

                // console.log(dateval.toLocaleDateString("en-US", options)); // Saturday, September 17, 2016
                // console.log(dateval.toLocaleDateString("hi-IN", options)); // शनिवार, 17 सितंबर 2016    
            },

            handleFileUpload() {
                this.form.attachments = this.$refs.uploadAttachments.files;
                console.log(this.$refs.uploadAttachments.files);
            },

            calltype(type) {
                if (type == 'firstdemoinstalation') {
                    return 'First demo and installation';
                }
                if (type == 'complaintcall') {
                    return 'Complaint Call';
                }
                if (type == 'reinstalation') {
                    return 'Re-instalation';
                }
            },
            addNewStatus() {
                this.form.post('/add-new-status')
                    .then(response => {
                        this.form.clear();
                        this.form.reset()
                        router.reload('/edit-call?callid='+this.item.requestno+'', {
                        only: ['statuses'],
                        });

                    })
            },
            updateNextVisit() {
                this.form2.post('add-new-status')
                    .then(response => {
                        this.form2.clear();
                        
                        console.log(response);
                    })
            }


        }
    }

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
