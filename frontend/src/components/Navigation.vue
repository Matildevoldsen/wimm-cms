<template>
    <b-navbar shadow wrapper-class="container">
        <template slot="brand">
            <b-navbar-item tag="router-link" to="/">
                Wimm CMS
            </b-navbar-item>
        </template>
        <template slot="start">
            <b-navbar-item tag="router-link" to="/">
                Home
            </b-navbar-item>
        </template>

        <template slot="end">
          <!-- <b-navbar-item tag="div">
                <b-dropdown aria-role="list" position="is-bottom-left">
                    <a
                            class="navbar-item"
                            slot="trigger"
                            role="button">
                            <span><flag iso="gb" /></span>
                        <span style="margin-left: 3px;">English</span>
                    </a>

                    <b-dropdown-item aria-role="listitem">
                        <span><flag iso="dk" /></span>
                        <span style="margin-left: 3px;">Dansk</span>
                    </b-dropdown-item>

                    <b-dropdown-item aria-role="listitem">
                        <span><flag iso="se" /></span>
                        <span style="margin-left: 3px;">Svenska</span>
                    </b-dropdown-item>

                    <b-dropdown-item aria-role="listitem">
                        <span><flag iso="no" /></span>
                        <span style="margin-left: 3px;">Norgsk</span>
                    </b-dropdown-item>

                    <b-dropdown-item aria-role="listitem">
                        <span><flag iso="es" /></span>
                        <span style="margin-left: 3px;">Spanish</span>
                    </b-dropdown-item>

                    <b-dropdown-item aria-role="listitem">
                        <span><flag iso="es" /></span>
                        <span style="margin-left: 3px;">Polish</span>
                    </b-dropdown-item>
                    
                </b-dropdown>
            </b-navbar-item>-->

            <b-navbar-item v-if="!user.authenticated" tag="div">
                <div class="buttons">
                    <router-link to="/register" class="button is-primary">
                        <strong>Sign up</strong>
                    </router-link>
                    <router-link class="button is-light" to="/login">
                        Log in
                    </router-link>
                </div>
            </b-navbar-item>

            <b-navbar-item v-if="user.authenticated" tag="div">
                <b-dropdown aria-role="list" position="is-bottom-left">
                    <a
                            class="navbar-item"
                            slot="trigger"
                            role="button">
                        <span>{{user.data.user.name}}</span>
                        <b-icon icon="caret-down"></b-icon>
                    </a>

                    <b-dropdown-item aria-role="listitem">Edit Profile</b-dropdown-item>
                    <b-dropdown-item aria-role="listitem">Change Password</b-dropdown-item>
                    <a v-on:click.prevent="signout">
                        <b-dropdown-item aria-role="listitem">Sign Out</b-dropdown-item>
                    </a>
                </b-dropdown>
            </b-navbar-item>
            <b-navbar-item v-if="user.authenticated && user.data.user.admin == 1" tag="div">
                <router-link class="button" to="/admin/overview">
                    <b-icon icon="tools"></b-icon> <span>Admin Dashboard</span>
                </router-link>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>
<script>
    import {mapState, mapActions} from 'vuex'

    export default {
        data() {
            return {
                isPublic: true
            }
        },
        computed: mapState({
            user: state => state.auth.user
        }),

        methods: {
            ...mapActions({
                logout: 'auth/logout'
            }),
            signout() {
                this.logout().then(() => {
                    this.$router.replace({name: 'home'})
                })
            }
        }
    }
</script>
