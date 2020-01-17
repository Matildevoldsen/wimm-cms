<template>
    <div class="container">
        <div class="columns">
            <div class="column is-2">
                <AdminMenu/>
            </div>
            <div class="column is-10">
                <div class="box m-t-50">
                    <section>
                        <b-field label="Title" :label-position="labelPosition">
                            <b-input v-model="title" placeholder="Category Title"></b-input>
                        </b-field>

                        <b-field label="Description" :label-position="labelPosition">
                            <quill-editor ref="myTextEditor"
                                          v-model="content"
                                          :options="editorOption"></quill-editor>
                        </b-field>

                        <b-field>
                            <div class="field">
                                <b-switch v-model="isPrivate">Keep category private?</b-switch>
                            </div>
                        </b-field>

                        <b-field>
                            <div class="field">
                                <b-switch v-model="showPage">Show the page for this category?</b-switch>
                            </div>
                        </b-field>

                        <b-field class="file">
                            <b-upload v-model="file">
                                <a class="button is-primary">
                                    <b-icon icon="upload"></b-icon>
                                    <span>Upload thumbnail</span>
                                </a>
                            </b-upload>
                            <span class="file-name" v-if="file">
                                {{ file.name }}
                            </span>
                        </b-field>
                        <hr/>
                        <p>Please note that the first 160 words of your description will be visible on search engines if turned on</p><br/>
                        <b-field>
                            <b-button v-if="this.file && this.content && this.title" type="is-success">Send</b-button>
                            <b-button v-if="!this.file || !this.content || !this.title" disabled type="is-danger">Please fill in all the forms</b-button>
                        </b-field>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import hljs from 'highlight.js'
    import javascript from 'highlight.js/lib/languages/javascript';

    export default {
        data() {
            return {
                title: null,
                showPage: false,
                isPrivate: false,
                file: null,
                labelPosition: 'on-border',
                content: ``,
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