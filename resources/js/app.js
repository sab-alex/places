
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import * as VueGoogleMaps from "vue2-google-maps";


window.Vue = require('vue');
Vue.use(VueGoogleMaps, {
    load: {
      key: "AIzaSyDEEuYTxsoUTB5EEyd_z1upqlCzl7X1RQg",
      libraries: "places"
    }
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('app-search', require('./components/SearchComponent.vue'));
Vue.component('app-marker', require('./components/MarkerComponent.vue'));
Vue.component('app-info-window', require('./components/InfoWindowComponent.vue'));
Vue.component('map-component', require('./components/MapComponent.vue'));

const app = new Vue({
    el: '#app'
});
