import 'jquery'
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import 'bootstrap-datepicker';
import 'bootstrap';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css';

// Other imports and code for your application

// Initialize bootstrap-datepicker
$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});

import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
