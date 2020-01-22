/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('input[name=sort_price]').change(function () {
    $(this).closest('form').submit()
});

$('input[name=status]').change(function () {
    let inputDateLeft = $(this).closest('.form-check').find('input[name=date_left]');
    if (inputDateLeft.length) {
    } else {
        $('input[name=date_left]').val('');
        $(this).closest('form').submit()
    }
});

$('input[name=date_left]').click(function () {
    $(this).closest('.form-check').find('input[name=status]').prop('checked', true)
});

$('.fa.fa-edit').click(function () {
    $('#modal_customer').modal('show')
});

$('input[name=avatar]').change(function () {
    console.log('VAO')
    let fileImg = $(this)[0].files[0];
    var reader = new FileReader();
    console.log(fileImg)
    reader.onload = function (e) {
        $('#image_avatar').attr('src', e.target.result)
    }
    reader.readAsDataURL(fileImg);
})
$('.btn-success').click(function (e) {
    // e.preventDefault();
})
