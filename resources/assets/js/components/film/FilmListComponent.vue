<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <img :v-if="currentPhotoUrl" class="card-img-top" :src="currentPhotoUrl" data-holder-rendered="true" style="height: 180px; width: 100%; display: block;">
                    <div class="card-header">
                        <a :v-show="currentShowUrl" :href="currentShowUrl">
                            <span :v-show="currentName">{{ currentName }}</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <!--<ul v-if="paginate && paginate.data.length > 0" class="mb-3">-->
                            <!--<li v-for="value,key in paginate.data[0]">-->
                                <!--{{ key }}: {{ value }}-->
                            <!--</li>-->
                        <!--</ul>-->
                        <a @click.prevent="getPage(paginate.current_page - 1)" v-show="paginate && paginate.prev_page_url" href="#" class="btn btn-primary float-left">Prev</a>
                        <a @click.prevent="getPage(paginate.current_page + 1)" v-show="paginate && paginate.next_page_url" href="#" class="btn btn-primary float-right">Next</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import http from '../../Http';
    export default {
        mounted() {
            this.getPage(this.initialPage);

        },
        computed: {
            currentName: function () {
                return (this.paginate && this.paginate.data.length > 0) ? this.paginate.data[0].name : '';
            },
            currentPhotoUrl: function () {
                return (this.paginate && this.paginate.data.length > 0) ? this.paginate.data[0].photo_url : '';
            },
            currentShowUrl: function () {
                return (this.paginate && this.paginate.data.length > 0) ? '/films/' + this.paginate.data[0].slug : '';
            }
        },
        props: {
            initialPage: {
                type: Number,
                default: 1
            }
        },
        data: function () {
            return {
                paginate: null,
            }
        },
        methods: {
            getPage(page) {
                http.get('api/films?per_page=1&page=' + page)
                    .then(response => {
                        this.paginate = response.data.data;
                    })
            }
        }
    }
</script>
