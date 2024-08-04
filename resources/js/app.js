/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import "@babel/polyfill";
import "core-js/stable";
import "regenerator-runtime/runtime";

require('./bootstrap');
var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };
// require('./assets/plugins/global/plugins.bundle');
// require('./assets/plugins/custom/prismjs/prismjs.bundle');

window.Vue = require('vue');
window.jQuery = window.$ = require('jquery')



// import Select2Component
import select2 from 'v-select2-component';
import VueSweetalert2 from 'vue-sweetalert2';
import draggable from 'vuedraggable';
import Loading from 'vue-loading-overlay';
import VeeValidate from 'vee-validate';
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { ErrorBag } from 'vee-validate';

import VdtnetTable from 'vue-datatables-net'

import 'datatables.net-bs4'
import 'datatables.net-responsive-bs4'
// below you should only import what you need
// Example: import buttons and plugins
import 'datatables.net-buttons/js/dataTables.buttons.js'
import 'datatables.net-buttons/js/buttons.html5.js'
import 'datatables.net-buttons/js/buttons.print.js'

// import the rest for your specific theme
import 'datatables.net-buttons-bs4'
import 'datatables.net-select-bs4'

import 'datatables.net-select-bs4/css/select.bootstrap4.min.css'
import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'

Vue.component('vdtnet-table', VdtnetTable);

Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);
// extend("required", {
//   ...required
// });

Vue.use(VdtnetTable);
Vue.component('loading', Loading);
Vue.component('select2', select2);
Vue.component('draggable', draggable);
Vue.use(Loading);
Vue.use(VueSweetalert2);
Vue.use(VeeValidate, {
    classes: true,
    classNames: {
        valid: 'is-valid',
        invalid: 'is-invalid'
    }
});

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueApexCharts from 'vue-apexcharts';
Vue.use(VueApexCharts);
Vue.component('parking', VueApexCharts)
import ParkingIndex from "./components/admin/parking/ParkingIndex.vue";
// new Vue({
//     render: h => h(ParkingIndex),
// }).$mount('#app')

Vue.use(VueAxios, axios)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/th';
Vue.component('date-picker', DatePicker)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('parkingindex-component', require('./components/ParkingIndex.vue').default);
Vue.component('apexchart', VueApexCharts);
Vue.use(VueApexCharts);
Vue.component('parking-index', ParkingIndex);

/****************************************** superadmin   **********************************/
Vue.component('superadmin-user-create', require('./components/superadmin/user-management/UserCreate.vue').default);
Vue.component('superadmin-user-edit', require('./components/superadmin/user-management/UserEdit.vue').default);
Vue.component('superadmin-company-create', require('./components/superadmin/company-management/CompanyCreate.vue').default);
Vue.component('superadmin-company-edit', require('./components/superadmin/company-management/CompanyEdit.vue').default);
Vue.component('superadmin-company-signature', require('./components/superadmin/company-management/CompanySignatureLayout.vue').default);
Vue.component('superadmin-company-objective-type', require('./components/superadmin/company-management/CompanyObjectiveTypeLayout.vue').default);
Vue.component('superadmin-company-user-create', require('./components/superadmin/company-management/CompanyCreateUser.vue').default);
Vue.component('superadmin-company-departments', require('./components/superadmin/company-management/CompanyDepartmentLayout.vue').default);
Vue.component('superadmin-company-change-note', require('./components/superadmin/company-management/CompanyChangeNote.vue').default);


/****************************************** admin   **********************************/
Vue.component('admin-user-show', require('./components/admin/user/UserShow.vue').default);
Vue.component('admin-appointment-create', require('./components/admin/appointment/AppointmentCreate.vue').default);
Vue.component('admin-appointment-edit', require('./components/admin/appointment/AppointmentEdit.vue').default);
Vue.component('admin-appointment-create-external', require('./components/admin/appointment/AppointmentCreateExternal.vue').default);
Vue.component('admin-blacklist-create', require('./components/admin/blacklist/BlacklistCreate.vue').default);
Vue.component('admin-blacklist-edit', require('./components/admin/blacklist/BlacklistEdit.vue').default);

// Vue.component('admin-parkingprice-setting', require('./components/admin/parkingprice/SettingParkingPrice.vue').default);
// Vue.component('admin-parkingprice-summary', require('./components/admin/parkingprice/SummaryParkingPrice.vue').default);


Vue.component('admin-parking-create', require('./components/admin/parking/ParkingCreate.vue').default);
// Vue.component('admin-parking-index', require('./components/admin/parking/ParkingIndex.vue').default);
/****************************************** admin end   **********************************/
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
});
