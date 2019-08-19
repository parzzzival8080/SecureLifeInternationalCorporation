require('./bootstrap');
window.Vue = require('vue');

import moment from 'moment';
import swal from 'sweetalert2'
import VueProgressBar from 'vue-progressbar'
import VueRouter from 'vue-router'
import {routes} from './routes';
import Vuetify from 'vuetify'
import Vue from 'vue'
import 'vuetify/dist/vuetify.min.css'
import 'vue/dist/vue.js'
import colors from 'vuetify/es5/util/colors'
import VueMaterial from 'vue-material'
import '../stylus/main.styl'
import 'vue-material/dist/vue-material.min.css'

Vue.use(Vuetify, {
  theme: {
    primary: colors.amber.darken3,
    secondary: colors.red.lighten4, // #FFCDD2
    accent: colors.indigo.base // #3F51B5
  }
})
Vue.use(VueRouter)
Vue.use(VueMaterial)

Vue.use(VueProgressBar, {
  color: '#FF8F00',
  thickness: '7px',
  failedColor: 'red',
  height: '3px'
})

window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000  
});

window.toast = toast;

window.custEvent = new Vue();

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })
  
  Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

  Vue.filter('myDate', function(created){
    return moment(created).format('LLLL')
});

Vue.component('App', require('./components/App.vue').default);
import App from './components/App.vue'
// Vue.component('Home', require('./components/main/Home.vue').default);
// import Home from './components/main/Home.vue'

const app = new Vue({
    el: '#app',
    router,
    components: {
      'App' : App,
      // 'Home' : Home,
    },
    data: () => ({
      drawer: true,
      dark: true,
      Newdialog: false,
      Keydialog: false
      
    }),
  
    props: {
      source: String
    },
    
});
