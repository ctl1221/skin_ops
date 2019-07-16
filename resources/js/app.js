require('./bootstrap');

import Toasted from 'vue-toasted';
import VueNumeric from 'vue-numeric'
import { Slider } from 'vue-color'

window.Vue = require('vue');
window.Toasted = require('vue-toasted');

Vue.use(Toasted);
Vue.use(VueNumeric);


// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sales-order-grid', require('./components/SalesOrderGrid.vue').default);
Vue.component('sales-order-grid-line', require('./components/SalesOrderGridLine.vue').default);
Vue.component('package-grid', require('./components/PackageGrid.vue').default);
Vue.component('payment-list', require('./components/PaymentList.vue').default);
Vue.component('my-vuetable', require('./components/MyVuetable.vue').default);
Vue.component('client-search', require('./components/ClientSearch.vue').default);
Vue.component('my-calendar', require('./components/MyCalendar.vue').default);
Vue.component('my-vue-circle', require('./components/MyVueCircle.vue').default);
Vue.component('color-picker', Slider);

Vue.filter('currencyFormat', function (value) {
	return value.toLocaleString('en-PH',{minimumFractionDigits: 2, maximumFractionDigits: 2});
});

Vue.filter('br', function (value) {
	return value.replace(/<br\s*\/?>/mg,"\n");
});
// const app = new Vue({
//     el: '#app'
// });
