<template>
    <AppLayout title="Users">

        <Head title="Calls" />
        <div >
            <div class="bg-white w-[600px] py-6 sm:py-6 lg:py-6 mx-auto" id="pdiv">
                <div class="bg-gray-300 p-2   text-center text-xl font-bold">Appliances Service Job Sheet</div>
                <div class="flex border-2 border-gray-300 ">
                    <div class="p-2">
                        <p class="text-gray-600 text-xl font-bold">Shree Sai Services</p>
                        <p>
                            IN0118896,SHOP NO .235 PRIYANKA CITY
                            PALACE,114, GODADARA RD,BEHIND MIDAS
                            SQUARE,PARVATGAM, SURAT,395010-SURAT
                            Contact No. 9898077528
                        </p>
                    </div>
                    
                </div>
                <div class="flex border-2 border-gray-300">
                    <div class="w-[38%] border-r-2 border-gray-300 text-center border-t-none">
                        <label class="font-bold text-gray-600">Customer Information
                        </label>
                        <div class="flex border-gray-300 border border-t-2">
                            <div class="w-[35%] border-r-2 border-gray-300"> Name</div>
                            <div class="w-[75%]"> Udaykiram Chennna</div>
                        </div>
                        <div class="border-gray-300 border ">
                            <div class="border-b-2  border-gray-300 "> Address</div>
                            <div class=" text-left"> G-51/52, navmangalam complex
                                citylight surat</div>
                        </div>
                        <div class="flex border-gray-300 border">
                            <div class="w-[35%] border-r-2 border-gray-300"> City / Pincode </div>
                            <div class="w-[75%]">  Surat / 395007</div>
                        </div>
                        <div class="flex border-gray-300 border ">
                            <div class="w-[35%] border-r-2 border-gray-300"> Contact No. </div>
                            <div class="w-[75%]"> 8238497619</div>
                        </div>
                        <div class="flex border-gray-300 border">
                            <div class="w-[35%] border-r-2 border-gray-300"> EMail ID  </div>
                            <div class="w-[75%]"> hafele.ccms@gmail.com</div>
                        </div>
                    </div>
                    <div class="w-[68%]  border-gray-300 text-center border-t-none">
                        <div class="flex">
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[22%]">Complaint No</div>
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[40%]">IN_A221128-726 </div>
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[15%]">Date:</div>
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[23%]">28/11/2022
                            </div>
                        </div>
                        <div class="flex">
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[22%]">Product</div>
                            <div class="border-r-2 text-gray-500  text-sm border-b-2 border-gray-300 w-[78%]">Dishwasher</div>
                        </div>
                        <div class="flex">
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[22%]">Brand</div>
                            <div class="border-r-2 text-gray-500  text-sm border-b-2 border-gray-300 w-[78%]">HAffle</div>
                        </div>
                        <div class="flex">
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 w-[22%]">Call Type </div>
                            <div class="border-r-2 text-gray-500  text-sm border-b-2 border-gray-300 w-[78%]">Installation & Demo</div>
                        </div>
                        <div class="">
                            <div class="border-r-2 text-gray-600 font-bold text-sm border-b-2 border-gray-300 ">ProblemRepoted (ByCustomer)</div>
                            <div class=" text-gray-500  text-sm  border-gray-300 ">DishwasherDishwasher Dishwasher Dishwasher Dishwasher DishwasherDishwasher  Dishwasher</div>
                        </div>
                     
                    </div>
                </div>
            </div>
            <div @click="createPDF">createPDF</div>
        </div>


    </AppLayout>
</template>

<script>
    import html2canvas from 'html2canvas';
    import jsPDF from 'jspdf';
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
    import StatusUpdate from './StatusUpdate.vue'

    import '@vuepic/vue-datepicker/dist/main.css'
    import {
        Head,
        Link,
        useForm
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
            StatusUpdate,
            Disclosure,
            DisclosureButton,
            DisclosurePanel,
            ChevronUpIcon

        },
        props: {
            call: Object,
            engineers: Object,
            assignedusers: Object,
            brands: Object,
            pcats: Object,
            statuses: Object
        },
        data() {
            return {
                createPDF() {
                    window.html2canvas = html2canvas;
                    var doc = jsPDF("p", "pt", "a4");
                    
                    doc.html(document.querySelector("#pdiv"), {
                        callback: function (pdf) {
                            pdf.save('mypdf.pdf');
                        }
                    });
                },
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
