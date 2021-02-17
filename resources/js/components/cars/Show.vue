<template>
    <div class="modal fade" id="modal-show-car" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                <h1>{{ car.model }} </h1>
                    Year: {{ car.year }}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>

import Vue from 'vue';

export default {
    data() {
        return {}
    },
    props: {
        car: Object
    },
    mounted() {
        console.log('Component show mounted')

    },
    methods: {},
    components: {}
}
</script>
