<template>
    <AppLayout title="Users">

        <Head title="Calls" />

        <div class="bg-gray-300 p-2 rounded-lg mt-1 flex justify-between">
            <Link :href="'/create-call'" class="btn btn-primary">Create New Call</Link>
            <!-- <button @click="openSearch" class="btn btn-primary">Filter list</button> -->
        </div>

        <div class="py-2">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="py-3 pl-2 bg-gray-300 rounded-lg flex flex-wrap" v-show="openSearchVal">
                        <div class="mr-2">
                            <InputLabel for="Lastname" value="Customer Code" />
                            <TextInput type="text" v-model="params.customerid" name="" class="p-1"></TextInput>
                        </div>
                        <div class="mr-2">
                            <InputLabel for="reqid" value="Request ID" />
                            <TextInput type="text" v-model="params.requestno" name="" class="p-1"></TextInput>
                        </div>
                        <div class="mr-2">
                            <InputLabel for="" value="Customer name" />
                            <TextInput v-model="params.name" type="text" name="" class="p-1"></TextInput>
                        </div>

                        <div class="mr-2">
                            <InputLabel for="" value="Call type" />
                            <select name="calltype" id="" v-model="params.calltype"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full p-1">
                                <option value="firstdemoinstalation">First demo and installation</option>
                                <option value="complaintcall">Complaint Call</option>
                                <option value="reinstalation">Re-instalation</option>
                            </select>
                        </div>
                        <div class="mr-2">
                            <InputLabel for="" value="Dates" />
                            <Datepicker v-model="params.dates" range multi-calendars />
                        </div>
                        <InputLabel for="" value="" />
                        <button @click="searchCalls" class="btn btn-success h-9 mt-auto mr-2">Search</button>
                        <button @click="clearSearch" class="btn btn-success h-9 mt-auto">Clear Search</button>
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
                                            <i class="cursor-pointer fa-solid fa-eye"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination class="mt-6" :links="calls.links" />

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
        useForm,
        router
    } from '@inertiajs/vue3';

    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue'

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
            TabPanel,
            Pagination

        },
        props: {
            calls: Object,
            engineers: Object,
            assignedusers: Object,
            brands: Object,
            pcats: Object,
            request:Object
        },
        data() {
            return {
                loading: false,
                form: new Form({

                }),
                params: {
                    dates: [],
                    requestno: this.request.requestno,
                    customerid: this.request.customerid,
                    name: this.request.name,
                    caltype: this.request.caltype,
                },
                form2: new Form({

                }),
                form3: new Form({

                }),
                isOpen: false,
                openEdit: false,
                openView: false,
                selectedAllocation: [],
                opendedItem: [],
                pcatsList: this.pcats,
                brandsList: this.brands,
                openSearchVal: true,

            }
        },
        mounted() {
            this.brandsList["Other"] = "Other";
            this.pcatsList["Other"] = "Other";
        },
        methods: {
            openEditModal(item) {
            this.$inertia.get('/edit-call',{callid: item.requestno});
               
            },
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
            openSearch() {
                this.openSearchVal = !this.openSearchVal
            },
            clearSearch(){
                this.params= {
                    dates: [],
                    requestno: null,
                    customerid: null,
                    name: null,
                    caltype: null,
                }
                this.searchCalls();
            },
            searchCalls() {
                let query = ''
                if (this.params.customerid != null && this.params.customerid != '') {

                }
               
                router.get(route('/open-calls'), {
                    customerid: this.params.customerid,
                    from: this.params.dates[0] ? this.params.dates[0] : null,
                    to: this.params.dates[1] ? this.params.dates[1] : null,
                    requestno: this.params.requestno,
                    name: this.params.name,
                    calltype: this.params.calltype,
                }, {
                    preserveState: false,
                });
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
            updateCustomer() {
                this.form3.post('update-customer')
                    .then(res => {
                        if (res.data.status) {
                            this.$inertia.get('/open-calls');
                        }
                    })
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
            }


        }
    }

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
