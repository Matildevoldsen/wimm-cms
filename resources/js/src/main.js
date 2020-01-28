import store from './vuex'
import router from './router'
import localforage from 'localforage'
import Vue from 'vue'
import './bootstrap'

import './assets/dependencies';

localforage.config({
    driver: localforage.LOCALSTORAGE,
    storeName: 'wimm-cms'
});

if ('serviceWorker' in navigator) {
    // Use the window load event to keep the page load performant
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/service-worker.js');
    });
  }

const App = Vue.component('App', require('./components/App.vue').default);
Vue.component('navigation', require('./components/Navigation.vue').default);
Vue.component('AdminMenu', require('./components/AdminMenu.vue').default);
Vue.component('Loader', require('./components/Loader.vue').default);

store.dispatch('topCategory/fetchTopCategories').then(() => {

});

store.dispatch('auth/setToken').then(() => {
    store.dispatch('auth/fetchUser').catch(() => {
        store.dispatch('auth/clearAuth')
        router.replace({name: 'login'})
    })
}).catch(() => {
    store.dispatch('auth/clearAuth')
});

new Vue({
    render: h => h(App),
    store,
    router,
    components: {App}
}).$mount('#app');
