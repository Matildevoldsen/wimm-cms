<template>
    <b-menu class="m-t-50">
        <b-menu-list label="Menu">
            <b-menu-item label="Pages">
                <router-link to="">
                    <b-menu-item label="Overview"></b-menu-item>
                </router-link>
                <b-menu-item label="New Page"></b-menu-item>
            </b-menu-item>
            <b-menu-item label="Top Category">
                <b-menu-item label="Overview"></b-menu-item>
                <b-menu-item label="New Category"></b-menu-item>
            </b-menu-item>
            <b-menu-item label="Under Category">
                <b-menu-item label="Overview"></b-menu-item>
                <b-menu-item label="New Page"></b-menu-item>
            </b-menu-item>
            <b-menu-item label="Articles">
                <b-menu-item label="Overview"></b-menu-item>
                <b-menu-item label="New Article"></b-menu-item>
            </b-menu-item>
            <b-menu-item label="Settings">
                <b-menu-item label="Language Support"></b-menu-item>
                <b-menu-item label="Edit Site"></b-menu-item>
            </b-menu-item>
        </b-menu-list>
        <b-menu-list label="Actions">
            <b-menu-item v-on:click.prevent="signout" label="Logout"></b-menu-item>
        </b-menu-list>
    </b-menu>
</template>
<script>
    import {mapState, mapActions} from 'vuex'

    export default {
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
