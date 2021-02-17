<template>
    <div class="wrapper">
        <simplert :useRadius="true"
                  :useIcon="true"
                  ref="simplert">
        </simplert>

        <va-navibar></va-navibar>
        <va-slider></va-slider>

        <div id="content-wrap" class="content-wrapper">
            <section class="content-header">
                <h1>
                    Cars
                    <small>manager all cars</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Cars</a></li>
                    <li class="active">All</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" id="btn_add" class="btn btn-primary btn-block margin-bottom btn-lg" data-toggle="modal"
                                data-target="#modal-default">
                            <span class="glyphicon glyphicon-plus"></span> Add
                        </button>
                        <div class="box box-primary">
                            <div class="box-header with-border"><h3 class="box-title"><span
                                class="glyphicon glyphicon-cog"></span> Access </h3>
                                <div class="box-tools">
                                    <button type="button" data-widget="collapse" class="btn btn-box-tool"><i
                                        class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="#" @click="getAll()"><i
                                        class="fa fa-fw fa-list-ul"></i> Brands
                                    </a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border"><h3 class="box-title"><span
                                class="glyphicon glyphicon-search"></span> Pesquisa</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" data-widget="collapse" class="btn btn-box-tool"><i
                                        class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <ValidationObserver v-slot="{ handleSubmit, invalid }">
                                    <form @submit.prevent="handleSubmit(onSubmit)">
                                        <div class="col-md-6">
                                            <ValidationProvider name="by" rules="required"
                                                                v-slot="{ errors, failed }">
                                                <div
                                                    :class="{'form-group': true,  'has-feedback': true, 'has-error': failed }">
                                                    <label for="by">By:</label>
                                                    <select v-model="by" id="by" name="by" class="form-control">
                                                        <option value="id" selected="selected">ID</option>
                                                        <option value="model">Model</option>
                                                        <option value="year">Year</option>
                                                    </select>
                                                    <span class="help-block">{{ errors[0] }}</span>
                                                </div>
                                            </ValidationProvider>
                                        </div>

                                        <div class="col-md-6">
                                            <ValidationProvider name="Operator" rules="required"
                                                                v-slot="{ errors, failed }">
                                                <div
                                                    :class="{'form-group': true,  'has-feedback': true, 'has-error': failed }">
                                                    <label for="operator">Operator:</label>
                                                    <select v-model="operator" id="operator" name="operator"
                                                            class="form-control">
                                                        <option value="=" selected="selected">Equal</option>
                                                        <option value="like">Like</option>
                                                    </select>
                                                    <span class="help-block">{{ errors[0] }}</span>
                                                </div>
                                            </ValidationProvider>
                                        </div>

                                        <div class="col-md-12">
                                            <ValidationProvider name="Keyword" rules="required|min:1|max:100"
                                                                v-slot="{ errors, failed }">
                                                <div
                                                    :class="{'input-group': true,  'has-feedback': true, 'has-error': failed }">
                                                    <input v-model="keyword" id="keyword" required="required"
                                                           name="keyword" type="id"
                                                           class="form-control" im-insert="true"
                                                           placeholder="Type key word...">
                                                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fa fa-search"></i> Search</button>
                        </span>
                                                </div>
                                                <span class="help-block text-red">{{ errors[0] }}</span>
                                            </ValidationProvider>
                                        </div>
                                    </form>
                                </ValidationObserver>

                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <span class="glyphicon glyphicon-th-list"></span>
                                <h3 class="box-title">Cars</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                            data-toggle="tooltip"
                                            title="" data-original-title="Collapse">
                                        <i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body" style="">
                                <DataTable
                                    :header-fields="headerFields"
                                    :sort-field="sortField"
                                    :sort="sort"
                                    :data="cars || []"
                                    :is-loading="isLoading"
                                    :css="datatableCss"
                                    not-found-msg="Items not found"
                                    @onUpdate="dtUpdateSort"
                                    trackBy="id"
                                >
                                    <template v-slot:actions="props">
                                        <button type="button" id="edit" class="btn btn-warning"
                                                @click="dtEditClick(props);">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                        <button type="button" id="show" class="btn btn-info"
                                                @click="dtShowClick(props);">
                                            <i class="fa fa-fw fa-reorder"></i>
                                        </button>
                                        <button type="button" id="destroy" class="btn btn-danger"
                                                @click="dtDestroyClick(props);">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </template>
                                    <Pagination
                                        slot="pagination"
                                        :page="currentPage"
                                        :total-items="totalItems"
                                        :items-per-page="itemsPerPage"
                                        :css="paginationCss"
                                        @onUpdate="changePage"
                                        @updateCurrentPage="updateCurrentPage"
                                    />
                                    <div class="items-per-page" slot="ItemsPerPage">
                                        <label>Items per page</label>
                                        <ItemsPerPageDropdown
                                            :list-items-per-page="listItemsPerPage"
                                            :items-per-page="itemsPerPage"
                                            :css="itemsPerPageCss"
                                            @onUpdate="updateItemsPerPage"
                                        />
                                    </div>

                                    <Spinner slot="spinner"/>


                                </DataTable>

                            </div>
                        </div>
                    </div>
                </div>
                <Add></Add>
                <Edit :car="car"></Edit>
                <Show :car="car"></Show>
            </section>
        </div>

        <va-footer></va-footer>
    </div>


</template>

<script>
import Vue from 'vue';

import VAFooter from '../Footer'
import VANaviBar from '../NavBar'
import VASlider from '../Slider'


import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

import Spinner from "vue-simple-spinner";
import {DataTable, ItemsPerPageDropdown, Pagination} from "v-datatable-light";
import orderBy from "lodash.orderby";

import CarService from '../../services/CarService'

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


import Add from '../../components/cars/Add'
import Edit from '../../components/cars/Edit'
import Show from '../../components/cars/Show'
import eventBus from '../../services/eventBus'

import Simplert from 'vue2-simplert';
export default {
    data() {
        return {
            car: {},
            by: '',
            operator: '',
            keyword: '',
            fullPage: true,
            cars: [],
            statusForm: 'New',
            isLoading: false,
            sort: "desc",
            sortField: "id",
            listItemsPerPage: [5, 10, 20, 50, 100],
            itemsPerPage: 10,
            currentPage: 1,
            totalItems: 0,
            datatableCss: {
                table: "table table-condensed table-hover table-striped",
                th: "header-item",
                thWrapper: "th-wrapper",
                thWrapperCheckboxes: "th-wrapper checkboxes",
                arrowsWrapper: "arrows-wrapper",
                arrowUp: "arrow up",
                arrowDown: "arrow down",
                footer: "footer"
            },
            paginationCss: {
                paginationItem: "pagination-item",
                moveFirstPage: "move-first-page",
                movePreviousPage: "move-previous-page",
                moveNextPage: "move-next-page",
                moveLastPage: "move-last-page",
                pageBtn: "page-btn"
            },
            itemsPerPageCss: {
                select: "item-per-page-dropdown"
            },
            headerFields: [
                {
                    name: "id",
                    label: "ID",
                    sortable: true
                },
                {
                    name: "model",
                    label: "Model",
                    sortable: true
                },
                {
                    name: "year",
                    label: "Year",
                    sortable: true
                },
                {
                    name: "created_at",
                    label: "Data",
                    sortable: true
                },
                "__slot:actions",
            ]
        }
    },
    mounted() {
        console.log('Car component monted')

        eventBus.$on('getAll', () => {
            this.getAll()
        })

        document.body.className = 'skin-blue sidebar-mini';
        this.getAll();
    },
    methods: {
        dtEditClick(props) {
            console.log('Props:', props)
            this.car = {
                'id': props.rowData.id,
                'model': props.rowData.model,
                'year': props.rowData.year,
                'brand_id': props.rowData.brand_id,
                'description': props.rowData.description
            }
            $('#modal-edit-car').modal('show')
        },
        dtShowClick(props) {
            console.log('Props:', props)
            this.car = {
                'id': props.rowData.id,
                'model': props.rowData.model,
                'year': props.rowData.year,
                'brand_id': props.rowData.brand_id,
                'description': props.rowData.description
            }
            $('#modal-show-car').modal('show')
        },
        dtDestroyClick(props) {
            this.id = props.rowData.id;

            let obj = {
                title: 'Remove ' + props.rowData.model ,
                message: 'Are you sure?',
                type: 'error',
                useConfirmBtn: true,
                customConfirmBtnText: 'Yes',
                customCloseBtnText: 'No',
                customConfirmBtnClass: 'btn btn-primary btn-block margin-bottom btn-lg',
                customCloseBtnClass: 'btn btn-danger btn-block margin-bottom btn-lg',
                onConfirm: this.destroy
            }
            this.$refs.simplert.openSimplert(obj)

        },
        destroy() {
            CarService.destroy(this.id)
                .then((response) => {
                    this.getAll()
                    Vue.$toast.open({
                        type: 'success',
                        message: response.body.message,
                        position: 'bottom',
                        duration: 5000
                    })
                })
                .catch((response) => {
                    Vue.$toast.open({
                        type: 'error',
                        message: response.body.message,
                        position: 'bottom',
                        duration: 5000
                    })
                })

        },
        onSubmit() {
            console.log('Searching...')
            this.isLoading = true
            CarService.search(this.by, this.operator, this.keyword)
                .then((response) => {
                    console.log('Cars search: ', response)
                    this.cars = response.body.data
                    this.currentPage = response.body.meta.pagination.current_page
                    this.totalItems = response.body.meta.pagination.total
                    this.itemsPerPage = response.body.meta.pagination.per_page
                    this.isLoading = false
                })
                .catch((error) => {
                    console.log('ERROR: ', error)
                })
        },
        getAll() {
            this.isLoading = true
            CarService.all(this.currentPage, this.itemsPerPage, this.sortField, this.sort)
                .then((response) => {
                    this.cars = response.body.data
                    console.log('Cars: ', response)
                    this.currentPage = response.body.meta.pagination.current_page
                    this.totalItems = response.body.meta.pagination.total
                    this.itemsPerPage = response.body.meta.pagination.per_page
                    this.isLoading = false
                })
                .catch((error) => {

                })
        },
        dtUpdateSort: function ({sortField, sort}) {
            this.isLoading = true
            console.log('New sort: ', sortField + ' ' + sort)

            CarService.all(this.currentPage, this.itemsPerPage, sortField, sort)
                .then((response) => {
                    console.log('Cars: ', response)
                    this.cars = response.body.data
                    this.currentPage = response.body.meta.pagination.current_page
                    this.totalItems = response.body.meta.pagination.total
                    this.itemsPerPage = response.body.meta.pagination.per_page
                    this.isLoading = false
                })
                .catch((error) => {

                })
        },

        updateItemsPerPage: function (itemsPerPage) {
            this.isLoading = true
            console.log("Updated list per page: ", itemsPerPage);
            CarService.all(this.currentPage, itemsPerPage, this.sortField, this.sort)
                .then((response) => {
                    console.log('Cars: ', response)
                    this.cars = response.body.data
                    this.currentPage = response.body.meta.pagination.current_page
                    this.totalItems = response.body.meta.pagination.total
                    this.itemsPerPage = response.body.meta.pagination.per_page
                    this.isLoading = false
                })
                .catch((error) => {

                })

        },
        changePage: function (currentPage) {
            this.isLoading = true
            CarService.all(currentPage, this.itemsPerPage, this.sortField, this.sort)
                .then((response) => {
                    console.log('Cars: ', response)
                    this.cars = response.body.data
                    this.currentPage = response.body.meta.pagination.current_page
                    this.totalItems = response.body.meta.pagination.total
                    this.itemsPerPage = response.body.meta.pagination.per_page
                    this.isLoading = false
                })
                .catch((error) => {

                })

            console.log("load data for the new page", currentPage);
        },

        updateCurrentPage: function (currentPage) {
            this.currentPage = currentPage;
            console.log("update current page without need to load data", currentPage);
        },
        onCancel() {
            console.log('User cancelled the loader.')
        },
    },
    components: {
        Simplert,
        Loading,
        'va-footer': VAFooter,
        'va-navibar': VANaviBar,
        'va-slider': VASlider,
        DataTable,
        ItemsPerPageDropdown,
        Pagination,
        Spinner,
        ValidationProvider,
        ValidationObserver,
        Add,
        Edit,
        Show


    }
}
</script>


<style>


#app .items-per-page {
    height: 100%;
    display: flex;
    align-items: center;
    color: #337ab7;
}

#app .items-per-page label {
    margin: 0 15px;
}

/* Datatable CSS */
#v-datatable-light .header-item {
    cursor: pointer;
    color: #337ab7;
    transition: color 0.15s ease-in-out;
}

#v-datatable-light .header-item:hover {
    color: #ed9b19;
}

#v-datatable-light .header-item.no-sortable {
    cursor: default;
}

#v-datatable-light .header-item.no-sortable:hover {
    color: #337ab7;
}

#v-datatable-light .header-item .th-wrapper {
    display: flex;
    width: 100%;
    height: 100%;
    font-weight: bold;
}

#v-datatable-light .header-item .th-wrapper.checkboxes {
    justify-content: center;
}

#v-datatable-light .header-item .th-wrapper .arrows-wrapper {
    display: flex;
    flex-direction: column;
    margin-left: 10px;
    justify-content: space-between;
}

#v-datatable-light .header-item .th-wrapper .arrows-wrapper.centralized {
    justify-content: center;
}

#v-datatable-light .arrow {
    transition: color 0.15s ease-in-out;
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
}

#v-datatable-light .arrow.up {
    border-bottom: 8px solid #337ab7;
}

#v-datatable-light .arrow.up:hover {
    border-bottom: 8px solid #ed9b19;
}

#v-datatable-light .arrow.down {
    border-top: 8px solid #337ab7;
}

#v-datatable-light .arrow.down:hover {
    border-top: 8px solid #ed9b19;
}

#v-datatable-light .footer {
    display: flex;
    justify-content: space-between;
    width: 500px;
}

/* End Datatable CSS */

/* Pagination CSS */
#v-datatable-light-pagination {
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin: 0;
    padding: 0;
    width: 300px;
    height: 30px;
}

#v-datatable-light-pagination .pagination-item {
    width: 30px;
    margin-right: 5px;
    font-size: 16px;
    transition: color 0.15s ease-in-out;
}

#v-datatable-light-pagination .pagination-item.selected {
    color: #ed9b19;
}

#v-datatable-light-pagination .pagination-item .page-btn {
    background-color: transparent;
    outline: none;
    border: none;
    color: #337ab7;
    transition: color 0.15s ease-in-out;
}

#v-datatable-light-pagination .pagination-item .page-btn:hover {
    color: #ed9b19;
}

#v-datatable-light-pagination .pagination-item .page-btn:disabled {
    cursor: not-allowed;
    box-shadow: none;
    opacity: 0.65;
}

/* END PAGINATION CSS */

/* ITEMS PER PAGE DROPDOWN CSS */
.item-per-page-dropdown {
    background-color: transparent;
    min-height: 30px;
    border: 1px solid #337ab7;
    border-radius: 5px;
    color: #337ab7;
}

.item-per-page-dropdown:hover {
    cursor: pointer;
}
</style>
