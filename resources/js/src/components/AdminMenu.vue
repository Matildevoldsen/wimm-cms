<template>
    <b-menu class="m-t-50">
        <b-menu-list label="Menu">
            <router-link to="/admin/overview" id="fix-align">
                <b-menu-item label="Overview"></b-menu-item>
            </router-link>
            <b-menu-item label="Pages">
                <router-link to="/admin/pages/home/edit">
                    <b-menu-item label="Edit Home Page"></b-menu-item>
                </router-link>
                <router-link to="/admin/pages/about/edit">
                    <b-menu-item label="Edt About Page"></b-menu-item>
                </router-link>
                <router-link to="/admin/pages/contact/edit">
                    <b-menu-item label="Edit Contact Page"></b-menu-item>
                </router-link>
                <router-link to="/admin/pages/overview">
                    <b-menu-item label="Overview"></b-menu-item>
                </router-link>
                <router-link to="/admin/pages/new">
                    <b-menu-item label="New Page"></b-menu-item>
                </router-link>
            </b-menu-item>
            <b-menu-item label="Top Category">
                <router-link to="/admin/topCategories/overview">
                    <b-menu-item label="Overview"></b-menu-item>
                </router-link>
                <router-link to="/admin/topCategories/new">
                    <b-menu-item label="New Category"></b-menu-item>
                </router-link>
            </b-menu-item>
            <b-menu-item label="Under Category">
                <router-link to="/admin/categories/overview">
                    <b-menu-item label="Overview"></b-menu-item>
                </router-link>
                <router-link to="/admin/category/new">
                    <b-menu-item label="New Category"></b-menu-item>
                </router-link>
            </b-menu-item>
            <b-menu-item label="Articles">
                <router-link to="/admin/articles/overview">
                    <b-menu-item label="Overview"></b-menu-item>
                </router-link>
                <router-link to="/admin/articles/new">
                    <b-menu-item label="New Article"></b-menu-item>
                </router-link>
            </b-menu-item>
            <b-menu-item label="Settings">
                <router-link to="">
                    <b-menu-item label="Language Support"></b-menu-item>
                </router-link>
                <router-link to="/admin/settings/edit">
                    <b-menu-item label="Edit Site"></b-menu-item>
                </router-link>
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
<style>
    #fix-align {
        padding: 0;
    }
</style>