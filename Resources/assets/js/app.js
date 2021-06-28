import Vue from 'vue';
import VerifyInput from './components/VerifyInput.vue';
import Modal from "./components/Modal";

window.Vue = require('vue');
require('vue-resource');

new Vue({
    el: '#stepform',
    components: {
        'codeinput': VerifyInput,
        'modal': Modal
    }
});