<template>
    <AppLayout title="Users">

        <Head title="Calls" />

       
        <TabGroup>
            <TabList class="bg-gray-300 my-2 p-1 rounded">
              <Tab class="mx-2" as="template" v-slot="{ selected }">
                <button :class="{ 'bg-blue-500 text-white': selected, 'bg-white text-black': !selected }" class="btn px-5">Customer & Call Update</button>
              </Tab>
              <Tab class="mx-2" as="template" v-slot="{ selected }">
                <button :class="{ 'bg-blue-500 text-white': selected, 'bg-white text-black': !selected }" class="btn px-5">Status Update</button>
              </Tab>
            </TabList>
            <TabPanels>
              <TabPanel>
                <div class="p-2  bg-white">
                    <UpdateCustomer :item="call" :engineers="engineers" :assignedusers="assignedusers" :brands="brands" :pcats="pcats" /> 
                    <UpdateCallDetails :item="call" :engineers="engineers" :assignedusers="assignedusers" :brands="brands" :pcats="pcats" />
                </div>
              </TabPanel>
              <TabPanel>
                <div class="p-2  bg-white">
                <StatusUpdate :item="call" :engineers="engineers" :assignedusers="assignedusers" :brands="brands" :pcats="pcats" :statuses="statuses"  />
                 </div>  
              </TabPanel>
            </TabPanels>
          </TabGroup>
    

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
        TabPanel,
        Disclosure, DisclosureButton, DisclosurePanel
    } from '@headlessui/vue'
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue'
    import Multiselect from '@vueform/multiselect'
    import Datepicker from '@vuepic/vue-datepicker';
    import UpdateCustomer from './UpdateCustomer.vue';
    import UpdateCallDetails from './UpdateCallDetails.vue';
    import StatusUpdate from './StatusUpdate.vue'

    import '@vuepic/vue-datepicker/dist/main.css'
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/inertia-vue3';

    import AppLayout from '@/Layouts/AppLayout.vue';

    import Form from 'vform'
    import axios from 'axios';
    import { ChevronUpIcon } from '@heroicons/vue/20/solid'
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
            StatusUpdate,
            Disclosure, DisclosureButton, DisclosurePanel,ChevronUpIcon

        },
        props: {
            call: Object,
            engineers: Object,
            assignedusers: Object,
            brands: Object,
            pcats: Object,
            statuses:Object
        },
        data() {
            return {
                categories: {
                    Recent: [{
                            id: 1,
                            title: 'Does drinking coffee make you smarter?',
                            date: '5h ago',
                            commentCount: 5,
                            shareCount: 2,
                        },
                        {
                            id: 2,
                            title: "So you've bought coffee... now what?",
                            date: '2h ago',
                            commentCount: 3,
                            shareCount: 2,
                        },
                    ],
                    Popular: [{
                            id: 1,
                            title: 'Is tech making coffee better or worse?',
                            date: 'Jan 7',
                            commentCount: 29,
                            shareCount: 16,
                        },
                        {
                            id: 2,
                            title: 'The most innovative things happening in coffee',
                            date: 'Mar 19',
                            commentCount: 24,
                            shareCount: 12,
                        },
                    ],
                    Trending: [{
                            id: 1,
                            title: 'Ask Me Anything: 10 answers to your questions about coffee',
                            date: '2d ago',
                            commentCount: 9,
                            shareCount: 5,
                        },
                        {
                            id: 2,
                            title: "The worst advice we've ever heard about coffee",
                            date: '4d ago',
                            commentCount: 1,
                            shareCount: 2,
                        },
                    ],
                },
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
                pcatsList: this.pcats,
                brandsList: this.brands,

            }
        },
        mounted() {
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
                this.$inertia.get('/edit-call', {
                    callid: item.requestno
                });

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
            updateCustomer() {
                this.form3.post('update-customer')
                    .then(res => {
                        if (res.data.status) {
                            // this.$inertia.get('/open-calls');
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
	 