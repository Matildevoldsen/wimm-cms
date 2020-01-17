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
                            <b-input placeholder="Category Title"></b-input>
                        </b-field>

                        <quill v-model="content" :config="config"></quill>

                        <div class="field">
                            <b-switch>Keep category private?</b-switch>
                        </div>

                        <div class="field">
                            <b-switch>Show the page for this category?</b-switch>
                        </div>

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
                        <b-field>
                            <b-button type="is-success">Send</b-button>
                        </b-field>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                file: null,
                labelPosition: 'on-border',
            }
        }
    }
</script>
