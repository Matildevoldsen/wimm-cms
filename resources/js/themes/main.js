import store from './buefy/vuex'
import router from './buefy/router'
import localforage from 'localforage'
import Vue from 'vue'
import './bootstrap'
import VueWait from 'vue-wait';
import './buefy/assets/dependencies';
import './buefy/helpers/filters.js'

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

store.dispatch("article/fetchArticles").then(() => {

});

new Vue({
  render: h => h(App),
  store,
  router,
  wait: new VueWait({
    registerComponent: true, // Registers `v-wait` component
    componentName: 'v-wait', // <v-wait> component name, you can set `my-loader` etc.

    registerDirective: true, // Registers `v-wait` directive
    directiveName: 'wait', // <span v-wait /> directive name, you can set `my-loader` etc.

  }),
  components: {
    App
  }
}).$mount('#app');