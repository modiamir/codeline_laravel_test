<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-default">
                    <div class="card-body">
                        <form @submit.prevent="submitComment" :action="'/films/' + filmId + '/comments'" method="post">
                            <div class="form-group">
                                <label for="comment-subject" :class="{'text-danger': errors.first('subject')}">Subject</label>
                                <input v-validate="'required'"
                                       type="text" :class="{'form-control': true, 'is-invalid': errors.first('subject') }"
                                       v-model="comment.subject"
                                       name="subject"
                                       id="comment-subject"
                                >
                                <small :v-if="errors.first('subject')" class="form-text text-danger">{{ errors.first('subject') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="comment-body" :class="{'text-danger': errors.first('body')}">Body</label>
                                <textarea v-validate="'required'" :class="{'form-control': true, 'is-invalid': errors.first('body') }" v-model="comment.body" name="body" id="comment-body" rows="3"></textarea>
                                <small :v-if="errors.first('body')" class="form-text text-danger">{{ errors.first('body') }}</small>
                            </div>

                            <input :disabled="formIsValid" type="submit" class="btn btn-info" value="Post">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import http from '../../Http';
    export default {
        props: {
            filmId: {
                type: Number
            },
            afterCreated: {
                type: Function
            }
        },
        data: function() {
            return {
                comment: {
                    subject: null,
                    body: null,
                }
            }
        },
        mounted() {

        },
        computed: {
            formIsValid: function () {
                this.$validator.validateAll().then((result) => {
                    return result;
                });

            }
        },
        methods: {
            submitComment(event) {
                let url = $(event.target).attr('action');
                let formData = new FormData();
                for (let key in this.comment) {
                    formData.append(key, this.comment[key]);
                }

                http.post(url, formData)
                    .then(response => {
                        this.afterCreated(response.data.data);
                        this.comment = {
                            subject: null,
                            body: null,
                        }
                    })
                    .catch(response => {
                        alert('Couln\'t create film. Check your data.');
                    })
            }
        }
    }
</script>
