import Vue from 'vue'
import App from './App.vue'
import BootstrapVue from 'bootstrap-vue'
import router from './router'
import axios from '@/plugins/axios'
import api from '@/router/rotasAPI.js'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


const plugin = {
  install() {
    Vue.prototype.$api = api;    
  },
};

Vue.use(plugin);
Vue.use(BootstrapVue);

Vue.prototype.$http = axios;
Vue.config.productionTip = false

new Vue({
  render: (h) => h(App),
  router,
}).$mount('#app')
