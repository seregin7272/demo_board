
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});


$(document).on('click', '.phone-button', function () {
    var button = $(this);
    axios.post(button.data('source')).then(function (response) {
        button.find('.number').html(response.data)
    }).catch(function (error) {
        console.error(error);
    });
});


$('.banner').each(function () {
    var block = $(this);
    var url = block.data('url');
    var format = block.data('format');
    var category = block.data('category');
    var region = block.data('region');

    axios
        .get(url, {params: {
                format: format,
                category: category,
                region: region
            }})
        .then(function (response) {
            block.html(response.data);
        })
        .catch(function (error) {
            console.error(error);
        });
});