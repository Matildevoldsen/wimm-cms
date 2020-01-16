<template>
    <section class="container m-t-50">
        <div class="columns is-centered">
            <div class="column is-6">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Sign In
                        </p>
                    </header>
                    <form v-on:keyup.enter.prevent="submit" action="#" method="post" role="form">
                        <div class="card-content">
                            <b-message has-icon v-if="errors.root" title="Error" type="is-danger"
                                       aria-close-label="Close message">
                                {{ errors.root }}
                            </b-message>

                            <b-field v-bind:message="errors.email" label="Email" :label-position="labelPosition">
                                <b-input type="email"
                                         required
                                         v-model="email">
                                </b-input>
                            </b-field>

                            <b-field v-bind:message="errors.password" label="Password" :label-position="labelPosition">
                                <b-input type="password"
                                         password-reveal
                                         minLength="8"
                                         required
                                         v-model="password"></b-input>
                            </b-field>

                            <b-button v-on:click.stop="submit" type="is-primary">Sign In</b-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    import {mapActions} from 'vuex'
    import {isEmpty} from 'lodash';

    export default {
        data() {
            return {
                labelPosition: 'on-border',
                email: null,
                password: null,
                errors: [],
            }
        },

        methods: {
            ...mapActions({
                login: 'auth/login'
            }),
            submit() {
                this.login({
                    payload: {
                        email: this.email,
                        password: this.password
                    },
                    context: this
                }).then(() => {
                    const getToken = localStorage.getItem('localforage/wimm_cms/authtoken');

                    if (!isEmpty(getToken)) {
                        this.$router.push('/')
                    }
                })
            },
        }
    }
</script>