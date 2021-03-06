
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Bulma Extensions - Carousel Module
require('../../../node_modules/bulma-extensions/bulma-carousel/dist/bulma-carousel.js');

// Croppie Module
import VueCroppie from 'vue-croppie';

window.Vue = require('vue');
import Buefy from 'buefy';

Vue.use(Buefy);
Vue.use(VueCroppie);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat-message', require('./components/ChatMessageComponent.vue'));
Vue.component('chat-log-component', require('./components/ChatLogComponent.vue'));
Vue.component('chat-composer-component', require('./components/ChatComposerComponent.vue'));

// const app = new Vue({
//     el: '#app',
//     data: {}
// });

/** 
 * Show Navigation on Burger button Click
*/

document.addEventListener('DOMContentLoaded', function () {

    // Get all "navbar-burger" elements
    let $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

                // Get the target from the "data-target" attribute
                let target = $el.dataset.target;
                let $target = document.getElementById(target);

                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

});
