<template>
    <div class="container">
        <div class="columns">
            <div class="column is-2">
                <AdminMenu/>
            </div>
            <div class="column is-10">
                <div class="box m-t-50" v-if="articles">
                    <p>Please note not all data is in the tables due to readability.</p>
                    <b-table
            :data="articles"
            paginated
            :total="total"
            :per-page="perPage"
            @page-change="onPageChange"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page">

            <template slot-scope="props">
                <b-table-column field="id" label="ID" sortable>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="title" label="Title" sortable>
                        {{ props.row.title }}
                </b-table-column>

                <b-table-column field="thumbnail" label="Thumbnail" sortable>
                        {{ props.row.cover }}
                </b-table-column>

                <b-table-column field="categoryTitle" label="Category" sortable>
                        {{ props.row.category[0].title }}
                </b-table-column>

                <b-table-column field="categoryID" label="Category ID" sortable>
                        {{ props.row.category[0].id }}
                </b-table-column>

                <b-table-column field="created_at" label="Created At" sortable centered>
                     {{ moment(props.row.created_at).fromNow() }}
                </b-table-column>

                <b-table-column field="updated_at" label="Updated at" sortable centered>
                    {{ moment(props.row.updated_at).fromNow() }}
                </b-table-column>

                <b-table-column label="Modify" width="500" centered>
                    <router-link :to="'/articles/' + props.row.id">View</router-link> | Edit | Delete
                </b-table-column>
            </template>
        </b-table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";
    import store from "../../../vuex";
    import moment from 'moment'

    export default {
        data() {
            return {
                total: 0,
                sortField: 'title',
                sortOrder: 'id',
                defaultSortOrder: 'id',
                page: 1,
                perPage: 10,
                moment: moment
            }
        },
        methods: {
            onPageChange(page) {
                this.page = page
            },
            truncate(value, length) {
                return value.length > length
                    ? value.substr(0, length) + '...'
                    : value
            }
        },
        computed: mapState({
            articles: state => state.article.articles.article
        }),
        mounted() {
            this.$wait.start("loading");
            store.dispatch('article/fetchArticles').then(() => {
                this.$wait.end("loading");
            });
        }
    }
</script>