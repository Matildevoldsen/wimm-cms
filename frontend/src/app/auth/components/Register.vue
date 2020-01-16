<template>
    <section class="container m-t-50">
        <div class="columns is-centered">
            <div class="column is-6">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Register
                        </p>
                    </header>
                    <div class="card-content">
                        <b-message has-icon v-if="errors.root" title="Error" type="is-danger"
                                   aria-close-label="Close message">
                            {{ errors.root }}
                        </b-message>
                        <form v-on:submit.prevent="submit" method="post"  action="#" role="form">
                            <b-field v-bind:message="errors.name" v-bind:type="errors.name ? 'is-danger' : ''" label="Full Name" :label-position="labelPosition">
                                <b-input type="text"
                                         required
                                         minLength="2"
                                         v-model="name">
                                </b-input>
                            </b-field>

                            <b-field v-bind:message="errors.email" v-bind:type="errors.email ? 'is-danger' : ''" label="Email" :label-position="labelPosition">
                                <b-input type="email"
                                         required
                                         v-model="email">
                                </b-input>
                            </b-field>

                            <b-field v-bind:type="errors.password ? 'is-danger' : ''" v-bind:message="errors.password" label="Password" :label-position="labelPosition">
                                <b-input type="password"
                                         password-reveal
                                         minLength="8"
                                         required
                                         v-model="password"></b-input>
                            </b-field>

                            <b-field v-bind:type="errors.confirm_password ? 'is-danger' : ''" v-bind:message="errors.confirm_password" label="Confirm Password" :label-position="labelPosition">
                                <b-input type="password"
                                         password-reveal
                                         minLength="8"
                                         required
                                         v-model="confirm_password"></b-input>
                            </b-field>

                            <b-button v-on:click.stop="submit" type="is-primary">Sign Up</b-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    import {mapActions} from 'vuex'
    import {isEmpty} from 'lodash'

    export default {
        data() {
            return {
                labelPosition: 'on-border',
                email: '',
                name: '',
                password: '',
                confirm_password: '',
                errors: [],
            }
        },
        methods: {
            ...mapActions({
                register: 'auth/register'
            }),
            submit() {
                this.register({
                    payload: {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        confirm_password: this.confirm_password
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
