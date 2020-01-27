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

Vue.use(FlagIcon);

Vue.use(VueQuillEditor)

Vue.use(buefy, {
    defaultIconPack: 'fas',
})