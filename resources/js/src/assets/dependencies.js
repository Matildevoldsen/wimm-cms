import Vue from 'vue';

//Dependencies
import buefy from 'buefy'
import VueQuillEditor from 'vue-quill-editor'
import FlagIcon from 'vue-flag-icon'

// Stylesheets
import 'highlight.js/styles/a11y-light.css';
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import 'buefy/dist/buefy.min.css';

import VueCodemirror from 'vue-codemirror'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

// require styles
import 'codemirror/lib/codemirror.css'

import VueWait from 'vue-wait'
import VueMoment from 'vue-moment'
import moment from 'moment-timezone'
 
Vue.use(VueMoment, {
    moment,
})
Vue.use(VueWait)
// you can set default global options and events when use
Vue.use(VueCodemirror, /* { 
  options: { theme: 'base16-dark', ... },
  events: ['scroll', ...]
} */)

Vue.use(FlagIcon);

Vue.use(VueQuillEditor)

Vue.use(buefy, {
    defaultIconPack: 'fas',
})