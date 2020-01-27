import Vue from 'vue'

export const Login = Vue.component('login', require('./Login.vue')).default;
export const Register = Vue.component('register', require('./Register.vue').default);
export const Forgot = Vue.component('forgot', require('./Forgot.vue').default);
export const Confirm = Vue.component('confirm', require('./Confirm.vue').default);
