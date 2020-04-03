import router from './buefy/router'
import localforage from 'localforage'
import Vue from 'vue'
import './bootstrap'
import './buefy/assets/dependencies';
import '../helpers/filters'

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

const App = Vue.component('App', require('./buefy/components/App.vue').default);
import './buefy/assets/globalComponents';

new Vue({
    render: h => h(App),
    router,
    components: {
        App
    }
}).$mount('#app');