import store from './vuex'
import localforage from 'localforage'
import buefy from 'buefy'
import router from './router'
import 'buefy/dist/buefy.min.css';
import Vue from 'vue'
import VueQuillEditor from 'vue-quill-editor'
import 'highlight.js/styles/a11y-light.css';

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor, /* { default global options } */)

Vue.use(buefy, {
    defaultIconPack: 'fas',
})

localforage.config({
    driver: localforage.LOCALSTORAGE,
    storeName: 'wimm-cms'
});

const App = Vue.component('App', require('./components/App.vue').default);
Vue.component('navigation', require('./components/Navigation.vue').default);
Vue.component('AdminMenu', require('./components/AdminMenu.vue').default);

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
