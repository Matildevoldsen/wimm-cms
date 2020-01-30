<template>
    <div class="container">
        <div class="columns">
            <div class="column is-2">
                <AdminMenu/>
            </div>
            <div class="column is-10">
                <div class="box m-t-50" v-if="categories">
                    <p>Please note not all data is in the tables due to readability.</p>
                    <b-table
            :data="categories"
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
                        {{ props.row.thumbnail }}
                </b-table-column>

                <b-table-column field="created_at" label="Created At" sortable centered>
                     {{ props.row.created_at }}
                </b-table-column>

                <b-table-column field="updated_at" label="Updated at" sortable centered>
                    {{ props.row.updated_at}}
                </b-table-column>

                <b-table-column label="Modify" width="500">
                    View | Edit | Delete
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

    export default {
        data() {
            return {
                total: 0,
                sortField: 'title',
                sortOrder: 'id',
                defaultSortOrder: 'id',
                page: 1,
                perPage: 10
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
            categories: state => state.category.categories.category
        }),
        mounted() {
            this.$wait.start("loading");
            store.dispatch('category/fetchCategories').then(() => {
                this.$wait.end("loading");
            });
        }
    }
</script>