


require('./bootstrap');

window.Vue = require('vue');

Vue.component('marca', require('./components/Marca.vue').default);
Vue.component('bus', require('./components/Bus.vue').default);
//Vue.component('departamento', require('./components/Departamento.vue').default);
Vue.component('ruta', require('./components/Ruta.vue').default);
Vue.component('conductor', require('./components/Conductor.vue').default);
Vue.component('cliente', require('./components/Cliente.vue').default);
Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('viaje', require('./components/Viaje.vue').default);
Vue.component('venta', require('./components/Venta.vue').default);


const app = new Vue({
    el: '#app',
    data:{
    	menu : 0
    }
});
