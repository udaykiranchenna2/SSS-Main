<template>
    <div>
        <div class="mt-2 px-6">
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
                        <textarea   id="description" v-model="form.description" type="text"  cols="40" rows="10"  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">\
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
               
            </div>
            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ml-4" @click="updateCall"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Update
                </PrimaryButton>
            </div>
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
            form: new Form({
                brandname:'',
                productcategory:'',
}),
        }
    },
    methods: {
        updateCall(){
                this.form.post('update-call')
                .then(res => {
                    if(res.data.status)
                    {
                        // this.$inertia.get('/open-calls');
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
              
                this.form.brandname = this.item.brand;
                this.form.calltype = this.item.calltype;
                this.form.productcategory = this.item.productcategory;
                this.form.description = this.item.description;
                this.form.visitdate = this.item.visitdate;
                this.form.requestno = this.item.requestno;
    }

}
</script>