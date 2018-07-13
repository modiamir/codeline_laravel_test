
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('film-create', require('./components/film/FilmCreateComponent.vue'));
Vue.component('film-list', require('./components/film/FilmListComponent.vue'));
Vue.component('comment-list', require('./components/comment/CommentListComponent.vue'));
Vue.component('comment-show', require('./components/comment/CommentShowComponent.vue'));
Vue.component('comment-create', require('./components/comment/CommentCreateComponent.vue'));

const app = new Vue({
    el: '#app'
});
