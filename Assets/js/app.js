import Vue from 'vue';
import Form from './components/Step.vue';
Vue.component('step-form', Form);

window.Vue = require('vue');
require('vue-resource');

new Vue({
    el: '#stepform',
    components: { Form }
});