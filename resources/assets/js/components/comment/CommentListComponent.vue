<template>
    <div class="bg-light p-3">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Comments</h2>
                <ul class="list-unstyled">
                    <li v-if="loggedIn" class="shadow-sm bg-white p-2 m-2">
                        <comment-create :after-created="prependComment" :film-id="filmId"></comment-create>
                    </li>
                    <li v-for="comment in comments" class="shadow-sm bg-white p-2 m-2">
                        <comment-show :comment="comment"></comment-show>
                    </li>
                </ul>
                <button :disabled="!loadMoreLink" @click.prevent="getPage(currentPage + 1)" class="btn btn-info d-block">Load More</button>
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
            loadMoreLink() {
                return this.paginate ? this.paginate.next_page_url : null;
            },
            currentPage() {
                return this.paginate ? this.paginate.current_page : 0;
            }
        },
        props: {
            initialPage: {
                type: Number,
                default: 1
            },
            filmId: {
                type: Number
            },
            loggedIn: {
                type: Boolean,
            }
        },
        data: function () {
            return {
                paginate: null,
                comments: [],
            }
        },
        methods: {
            getPage(page) {
                http.get('films/' + this.filmId + '/comments?per_page=5&page=' + page)
                    .then(response => {
                        this.paginate = response.data.data;
                        this.comments = this.comments.concat(this.paginate.data)
                    })
            },
            prependComment(comment) {
                this.comments = [comment].concat(this.comments)
            }
        }
    }
</script>
