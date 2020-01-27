<template>
    <div class="container">
        <div class="columns">
            <div class="column is-2">
                <AdminMenu/>
            </div>
            <div class="column is-10">
                <div class="box m-t-50">
                    <form action="#" method="post" enctype="multipart/form-data">
                            <b-message has-icon v-if="errors.root" title="Error" type="is-danger"
                                       aria-close-label="Close message">
                                {{ errors.root }}
                            </b-message>
                        <section>
                            <b-field v-bind:message="errors.title"  v-bind:type="errors.title ? 'is-danger' : ''" label="Title" :label-position="labelPosition">
                                <b-input v-model="title" placeholder="Category Title"></b-input>
                            </b-field>

                            <b-field v-bind:message="errors.description"  v-bind:type="errors.description ? 'is-danger' : ''" label="Description" :label-position="labelPosition">
                                <quill-editor ref="myTextEditor"
                                            v-model="description"
                                            :options="editorOption"></quill-editor>
                            </b-field>

                            <b-field label="Over Category">
                                <b-select placeholder="Choose Over Category">
                                    <option
                                        v-for="option in topCategories"
                                        :value="option.id"
                                        :key="option.id">
                                        {{ option.title }}
                                    </option>
                                </b-select>
                            </b-field>

                            <b-field v-bind:message="errors.is_private"  v-bind:type="errors.is_private ? 'is-danger' : ''">
                                <div class="field">
                                    <b-switch v-model="is_private">Keep category private?</b-switch>
                                </div>
                            </b-field>

                            <b-field v-bind:message="errors.show_in_navigation"  v-bind:type="errors.show_in_navigation ? 'is-danger' : ''">
                                <div class="field">
                                    <b-switch v-model="show_in_navigation">Show this in the navigation bar?</b-switch>
                                </div>
                            </b-field>

                            <b-field v-bind:message="errors.show_in_footer"  v-bind:type="errors.show_in_footer ? 'is-danger' : ''">
                                <div class="field">
                                    <b-switch v-model="show_in_footer">Show this in the footer?</b-switch>
                                </div>
                            </b-field>

                            <b-field v-bind:message="errors.has_page"  v-bind:type="errors.has_page ? 'is-danger' : ''">
                                <div class="field">
                                    <b-switch v-model="has_page">Show the page for this category?</b-switch>
                                </div>
                            </b-field>

                            <b-field v-bind:message="errors.thumbnail"  v-bind:type="errors.thumbnail ? 'is-danger' : ''" class="file">
                                <b-upload accept="image/*" drag-drop v-model="thumbnail">
                                    <section class="section">
                                        <div class="content has-text-centered">
                                            <p>
                                                <b-icon
                                                        icon="upload"
                                                        size="is-large">
                                                </b-icon>
                                            </p>
                                            <p>Drag an image or click the button to upload</p>
                                        </div>
                                    </section>
                                </b-upload>
                            </b-field>
                            <div class="tags" v-if="thumbnail">
                                    <span class="tag is-primary">{{ thumbnail.name }}
                                        <button class="delete is-small"
                                                type="button"
                                                @click="deleteDropFile">
                                        </button>
                                    </span>
                            </div>
                            <!-- <b-field label="Language">
                                <b-select placeholder="Choose an language" v-model="language">
                                    <option value="English">English</option>
                                    <option value="Danish">Danish</option>
                                    <option value="Swedish">Swedish</option>
                                    <option value="Norwegian">Norwegian</option>
                                    <option value="German">German</option>
                                    <option value="Spanish">Spanish</option>
                                    <option value="Polish">Polish</option>
                                </b-select>
                            </b-field> -->
                            <hr/>
                            <p>Please note that the first 160 words of your description will be visible on search engines if
                                turned on</p><br/>
                            <b-field>
                                <b-button v-if="this.thumbnail && this.description && this.title" v-on:click.stop="submit" type="is-success">Send</b-button>
                                <b-button v-if="!this.thumbnail || !this.description || !this.title" disabled type="is-danger">Please
                                    fill in all the forms
                                </b-button>
                            </b-field>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapActions} from 'vuex'
    import {mapState} from "vuex";
    import hljs from 'highlight.js'
    import javascript from 'highlight.js/lib/languages/javascript';

    export default {
        data() {
            return {
                title: null,
                has_page: false,
                is_private: false,
                show_in_navigation: true,
                show_in_footer: true,
                thumbnail: null,
                //language: 'English',
                labelPosition: 'on-border',
                description: ``,
                errors: [],
                success: [],
                editorOption: {
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{'header': 1}, {'header': 2}],
                            [{'list': 'ordered'}, {'list': 'bullet'}],
                            [{'script': 'sub'}, {'script': 'super'}],
                            [{'indent': '-1'}, {'indent': '+1'}],
                            [{'direction': 'rtl'}],
                            [{'size': ['small', false, 'large', 'huge']}],
                            [{'header': [1, 2, 3, 4, 5, 6, false]}],
                            [{'font': []}],
                            [{'color': []}, {'background': []}],
                            [{'align': []}],
                            ['clean'],
                            ['link', 'image', 'video']
                        ],
                        syntax: {
                            highlight: text => hljs.highlightAuto(text).value
                        }
                    }
                }
            }
        },
        methods: {
            ...mapActions({
                topCategory: 'topCategory/addTopCategory'
            }),
            submit() {
                this.topCategory({
                    payload: {
                        title: this.title,
                        description: this.description,
                        thumbnail: this.thumbnail,
                        has_page: this.has_page,
                        is_private: this.is_private,
                        show_in_footer: this.show_in_footer,
                        show_in_navigation: this.show_in_navigation
                    },
                    context: this
                }).then(() => {
                    console.log(this.success)
                })
            },
            deleteDropFile() {
                this.thumbnail = null
            },
        },
        computed: mapState({
            topCategories: state => state.topCategory.topCategories.category
        }),
        mounted() {
            hljs.registerLanguage('javascript', javascript);
        },
    }
</script>
<style type="text/scss">
    .quill-editor {
        z-index: 1000;
    }
</style>