<template>
    <div class="container">
        <div class="columns">
            <div class="column is-2">
                <AdminMenu/>
            </div>
            <div class="column is-10">
                <div class="box m-t-50">
                    <nav class="level is-mobile">
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">New Users</p>
                                <p class="title">{{ admin.stats.users }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">New Articles</p>
                                <p class="title">{{ admin.stats.articles }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">New Categories</p>
                                <p class="title">{{ admin.stats.categories }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">New Top Categories</p>
                                <p class="title">{{ admin.stats.topCategories }}</p>
                            </div>
                        </div>
                    </nav>
                    <hr />
                    <p>All of the data below is for the current month.</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import store from "../../../vuex";
    import {mapState} from "vuex";

    export default {
        mounted() {
            store.dispatch('admin/fetchStats').then(() => {
            });
        },
        computed: mapState({
            admin: state => state.admin
        }),
    }
</script>