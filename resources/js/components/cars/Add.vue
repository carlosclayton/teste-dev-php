<template>
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h3 class="modal-title"><span class="glyphicon glyphicon-user"></span> New car
                    </h3>
                </div>
                <ValidationObserver v-slot="{ handleSubmit, invalid }">
                    <form id="carForm" @submit.prevent="handleSubmit(onCarSubmit)">
                        <div class="modal-body">

                            <ValidationProvider name="Model" rules="required|min:3|max:100"
                                                v-slot="{ errors, failed }">
                                <div :class="{'form-group': true,  'has-feedback': true, 'has-error': failed }">
                                    <label for="model">Model</label>
                                    <input v-model="model" name="model" id="model" type="text" class="form-control" placeholder="Type Model">

                                    <span class="help-block">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>


                            <ValidationProvider name="Year" rules="required|min:3|max:4"
                                                v-slot="{ errors, failed }">
                                <div :class="{'form-group': true,  'has-feedback': true, 'has-error': failed }">
                                    <label for="year">Year</label>
                                    <input v-model="year" name="year" id="year" type="text" class="form-control" placeholder="Type Year">

                                    <span class="help-block">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>

                            <ValidationProvider name="Brand" rules="required"
                                                v-slot="{ errors, failed }">
                                <div :class="{'form-group': true,  'has-feedback': true, 'has-error': failed }">
                                    <label for="">Brand</label>
                                    <select v-model="brand_id" name="brand_id" id="brand_id"
                                            class="form-control"
                                            required>
                                        <option v-for="option in brands" v-bind:value="option.id">
                                            {{ option.name }}
                                        </option>
                                    </select>

                                    <span class="help-block">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </ValidationObserver>
            </div>
        </div>
    </div>

</template>

<script>
// In your Javascript (external .js resource or <script> tag)

import Vue from 'vue';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);


import {extend} from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import {messages} from 'vee-validate/dist/locale/pt_BR.json';

import {ValidationProvider, ValidationObserver} from 'vee-validate';

Object.keys(rules).forEach(rule => {
    extend(rule, {
        ...rules[rule], // copies rule configuration
        message: messages[rule] // assign message
    });
});

import eventBus from '../../services/eventBus'

import BrandService from '../../services/BrandService'
import CarService from '../../services/CarService'

export default {
    data() {
        return {
            model: '',
            year: '',
            brand_id: '',
            description: '',
            isLoading: false,
            sort: "desc",
            sortField: "id",
            itemsPerPage: 10,
            currentPage: 1,
            brands: [],
        }
    },
    mounted() {
        console.log('Modal Component mounted.')
        this.getAll();
    },
    methods: {
        getAll() {
            BrandService.all(this.currentPage, this.itemsPerPage, this.sortField, this.sort)
                .then((response) => {
                    this.brands = response.body.data
                    console.log('Brands: ', response)
                    this.currentPage = response.body.meta.pagination.current_page
                    this.totalItems = response.body.meta.pagination.total
                    this.itemsPerPage = response.body.meta.pagination.per_page

                })
                .catch((error) => {

                })
        },
        onCarSubmit() {
            console.log('Submit car')
            this.isLoading = true
            CarService.add(this.model, this.year, this.brand_id)
                .then((response) => {
                    $('#modal-default').modal('hide')
                    eventBus.$emit('getAll')
                    this.isLoading = false
                    Vue.$toast.open({
                        type: 'success',
                        message: response.body.message,
                        position: 'bottom',
                        duration: 5000
                    })
                })
                .catch((error) => {
                    Vue.$toast.open({
                        type: 'error',
                        message: response.body.errors.message,
                        position: 'bottom',
                        duration: 5000
                    })
                })
        },
    },
    components: {
        ValidationProvider,
        ValidationObserver,
    }
}
</script>
