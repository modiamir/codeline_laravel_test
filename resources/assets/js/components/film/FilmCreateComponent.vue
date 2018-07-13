<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-default">
                    <div class="card-body">
                        <form @submit.prevent="createFilm" action="/films" method="post">
                            <div class="form-group">
                                <label for="film-name" :class="{'text-danger': errors.first('name')}">Name</label>
                                <input v-validate="'required'" type="text" :class="{'form-control': true, 'is-invalid': errors.first('name') }" v-model="film.name" name="name" id="film-name" aria-describedby="helpId"
                                       placeholder="">
                                <small :v-if="errors.first('name')" id="helpId" class="form-text text-danger">{{ errors.first('name') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="film-description" :class="{'text-danger': errors.first('description')}">Description</label>
                                <textarea v-validate="'required'" :class="{'form-control': true, 'is-invalid': errors.first('description') }" v-model="film.description" name="description" id="film-description" rows="3"></textarea>
                                <small :v-if="errors.first('description')" class="form-text text-danger">{{ errors.first('description') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="film-release_date" :class="{'text-danger': errors.first('release_date')}">Release Date</label>
                                <input v-validate="'required|date_format:YYYY/MM/DD'" type="text" :class="{'form-control': true, 'is-invalid': errors.first('release_date') }" v-model="film.release_date" name="release_date" id="film-release_date" aria-describedby="helpId"
                                       placeholder="">
                                <small :v-if="errors.first('release_date')" class="form-text text-danger">{{ errors.first('release_date') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="film-rating" :class="{'text-danger': errors.first('rating')}">Rating</label>
                                <input v-validate="'required|integer|min_value:1|max_value:5'" type="text" :class="{'form-control': true, 'is-invalid': errors.first('rating') }" v-model="film.rating" name="rating" id="film-rating" placeholder="">
                                <small :v-if="errors.first('rating')" class="form-text text-danger">{{ errors.first('rating') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="film-ticket_price" :class="{'text-danger': errors.first('ticket_price')}">Ticket Price</label>
                                <input v-validate="'required|numeric|min_value:0'" type="text" :class="{'form-control': true, 'is-invalid': errors.first('ticket_price') }" v-model="film.ticket_price" name="ticket_price" id="film-ticket_price" placeholder="">
                                <small :v-if="errors.first('ticket_price')" class="form-text text-danger">{{ errors.first('ticket_price') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="film-country" :class="{'text-danger': errors.first('country')}">Country</label>
                                <input v-validate="'required'" type="text" :class="{'form-control': true, 'is-invalid': errors.first('country') }" v-model="film.country" name="country" id="film-country" aria-describedby="helpId"
                                       placeholder="">
                                <small :v-if="errors.first('country')" class="form-text text-danger">{{ errors.first('country') }}</small>
                            </div>
                            <div class="form-group">
                                <label :class="{'text-danger': errors.first('genres')}" for="film-genres">Genres</label>
                                <select v-validate="'required|min:1'" multiple :class="{'form-control': true, 'is-invalid': errors.first('country') }" v-model="film.genres" name="genres" id="film-genres">
                                    <option v-for="genre in genres" v-bind:value="genre.id ">{{genre.name}}</option>
                                </select>
                                <small :v-if="errors.first('genres')" class="form-text text-danger">{{ errors.first('genres') }}</small>
                            </div>
                            <div class="form-group">
                                <label :class="{'text-danger': errors.first('photo')}" for="film-photo">Photo</label>
                                <input v-validate="'required|image'"
                                       type="file"
                                       :class="{'form-control-file': true, 'is-invalid': errors.first('photo') }"
                                       name="photo"
                                       id="film-photo"
                                       accept="image/*"
                                       @change="filesChange($event.target.files)"
                                />

                                <small :v-if="errors.first('photo')" class="form-text text-danger">{{ errors.first('photo') }}</small>
                            </div>
                            <input :disabled="formIsValid" type="submit" class="btn btn-info" value="Create">
                        </form>
                        {{film}}
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
            genres: {
                type: Array
            },
        },
        data: function() {
            return {
                film: {
                    name: "asdasd",
                    description: "asdasd",
                    release_date: "2018/01/02",
                    rating: "1",
                    ticket_price: "12",
                    country: "asdasd",
                    genres: []
                }
            }
        },
        mounted() {
            console.log(this.genres)
        },
        computed: {
            formIsValid: function () {
                this.$validator.validateAll().then((result) => {
                    return result;
                });

            }
        },
        methods: {
            filesChange(files) {
                this.film.photo = files[0];
            },
            createFilm(event) {
                let url = $(event.target).attr('action');
                let formData = new FormData();
                for (let key in this.film) {
                    if (key === 'genres') {
                        for (let i = 0; i < this.film['genres'].length; i ++) {
                            formData.append('genres[]', this.film['genres'][i]);
                        }
                        continue;
                    }

                    formData.append(key, this.film[key]);
                }

                http.post(url, formData)
                    .then(response => {
                        window.location.replace("/films/" + response.data.data.slug);

                    })
                    .catch(response => {
                        alert('Couln\'t create film. Check your data.');
                    })
            }
        }
    }
</script>
