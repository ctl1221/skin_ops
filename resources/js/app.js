require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sales-order-grid', require('./components/SalesOrderGrid.vue').default);
Vue.component('sales-order-grid-line', require('./components/SalesOrderGridLine.vue').default);


// const app = new Vue({
//     el: '#app'
// });
