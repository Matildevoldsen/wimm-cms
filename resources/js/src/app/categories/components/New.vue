<template>
  <div class="container">
    <div class="columns">
      <div class="column is-2">
        <AdminMenu />
      </div>
      <div class="column is-10">
        <div class="box m-t-50">
          <b-tabs type="is-toggled" v-if="topCategories">
            <b-tab-item label="Category" icon="pen">
              <form action="#" method="post" enctype="multipart/form-data">
                <b-message
                  has-icon
                  v-if="errors.root"
                  title="Error"
                  type="is-danger"
                  aria-close-label="Close message"
                >{{ errors.root }}</b-message>
                <section>
                  <b-field
                    v-bind:message="errors.title"
                    v-bind:type="errors.title ? 'is-danger' : ''"
                    label="Title"
                    :label-position="labelPosition"
                  >
                    <b-input v-model="title" placeholder="Category Title"></b-input>
                  </b-field>

                  <b-field
                    v-bind:message="errors.description"
                    v-bind:type="errors.description ? 'is-danger' : ''"
                    label="Description"
                    :label-position="labelPosition"
                  >
                    <quill-editor ref="myTextEditor" v-model="description" :options="editorOption"></quill-editor>
                  </b-field>

                  <b-field
                    v-bind:message="errors.top_category_id"
                    v-bind:type="errors.top_category_id ? 'is-danger' : ''"
                    :label-position="labelPosition"
                    label="Over Category"
                  >
                    <b-select v-model="top_category_id" placeholder="Choose Over Category">
                      <option
                        v-for="option in topCategories"
                        :value="option.id"
                        :key="option.id"
                      >{{ option.title }}</option>
                    </b-select>
                  </b-field>

                  <b-field
                    v-bind:message="errors.is_private"
                    v-bind:type="errors.is_private ? 'is-danger' : ''"
                  >
                    <div class="field">
                      <b-switch v-model="is_private">Keep category private?</b-switch>
                    </div>
                  </b-field>

                  <b-field
                    v-bind:message="errors.show_in_navigation"
                    v-bind:type="errors.show_in_navigation ? 'is-danger' : ''"
                  >
                    <div class="field">
                      <b-switch v-model="show_in_navigation">Show this in the navigation bar?</b-switch>
                    </div>
                  </b-field>

                  <b-field
                    v-bind:message="errors.show_in_footer"
                    v-bind:type="errors.show_in_footer ? 'is-danger' : ''"
                  >
                    <div class="field">
                      <b-switch v-model="show_in_footer">Show this in the footer?</b-switch>
                    </div>
                  </b-field>

                  <b-field
                    v-bind:message="errors.has_page"
                    v-bind:type="errors.has_page ? 'is-danger' : ''"
                  >
                    <div class="field">
                      <b-switch v-model="has_page">Show the page for this category?</b-switch>
                    </div>
                  </b-field>

                  <b-field
                    v-bind:message="errors.thumbnail"
                    v-bind:type="errors.thumbnail ? 'is-danger' : ''"
                    class="file"
                  >
                    <b-upload accept="image/*" drag-drop v-model="thumbnail">
                      <section class="section">
                        <div class="content has-text-centered">
                          <p>
                            <b-icon icon="upload" size="is-large"></b-icon>
                          </p>
                          <p>Drag an image or click the button to upload</p>
                        </div>
                      </section>
                    </b-upload>
                  </b-field>
                  <div class="tags" v-if="thumbnail">
                    <span class="tag is-primary">
                      {{ thumbnail.name }}
                      <button
                        class="delete is-small"
                        type="button"
                        @click="deleteDropFile"
                      ></button>
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
                  </b-field>-->
                  <hr />
                  <br />
                  <b-field>
                    <b-button
                      v-if="this.thumbnail && this.description && this.title"
                      v-on:click.stop="submit"
                      type="is-success"
                    >Send</b-button>
                    <b-button
                      v-if="!this.thumbnail || !this.description || !this.title"
                      disabled
                      type="is-danger"
                    >
                      Please
                      fill in all the forms
                    </b-button>
                  </b-field>
                </section>
              </form>
            </b-tab-item>
            <b-tab-item label="Advanced" icon="tools">
              <b-field
                v-bind:message="errors.lang"
                v-bind:type="errors.lang ? 'is-danger' : ''"
                label="Language"
                :label-position="labelPosition"
              >
                <b-select v-model="lang" placeholder="E.g. English">
                  <option selected value="English">English</option>
                </b-select>
              </b-field>

              <b-field
                v-bind:message="errors.seo_desc"
                v-bind:type="errors.seo_desc ? 'is-danger' : ''"
                label="SEO Description"
                :label-position="labelPosition"
              >
                <b-input v-model="seo_desc"></b-input>
              </b-field>

              <b-field
                v-bind:message="errors.thumbnail_alt"
                v-bind:type="errors.thumbnail_alt ? 'is-danger' : ''"
                label="Image Description"
                :label-position="labelPosition"
              >
                <b-input v-model="thumbnail_alt"></b-input>
              </b-field>
            </b-tab-item>
          </b-tabs>
          <template v-if="topCategories < 1">
            <p>
              To create an under category you need to make sure you've created an
              <router-link to="/admin/topCategories/new">category first.</router-link>
            </p>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import store from "../../../vuex";
import { mapActions } from "vuex";
import { mapState } from "vuex";
import { isEmpty } from 'lodash'
import hljs from "highlight.js";
import javascript from "highlight.js/lib/languages/javascript";

export default {
  data() {
    return {
      title: null,
      has_page: false,
      is_private: false,
      show_in_navigation: true,
      show_in_footer: true,
      thumbnail: null,
      lang: "English",
      seo_desc: "",
      thumbnail_alt: "",
      top_category_id: 1,
      //language: 'English',
      labelPosition: "on-border",
      description: ``,
      errors: [],
      success: [],
      editorOption: {
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"],
            ["blockquote", "code-block"],
            [{ header: 1 }, { header: 2 }],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ script: "sub" }, { script: "super" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ direction: "rtl" }],
            [{ size: ["small", false, "large", "huge"] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            [{ font: [] }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
            ["clean"],
            ["link", "image", "video"]
          ],
          syntax: {
            highlight: text => hljs.highlightAuto(text).value
          }
        }
      }
    };
  },
  methods: {
    ...mapActions({
      category: "category/addCategory"
    }),
    submit() {
      this.category({
        payload: {
          title: this.title,
          description: this.description,
          thumbnail: this.thumbnail,
          has_page: this.has_page,
          is_private: this.is_private,
          show_in_footer: this.show_in_footer,
          show_in_navigation: this.show_in_navigation,
          language: this.lang ? this.lang : "English",
          seo_desc: this.seo_desc
            ? this.seo_desc
            : this.description.replace(/(<([^>]+)>)/gi, "").substring(0, 160),
          thumbnail_alt: this.thumbnail_alt,
          top_category_id: this.top_category_id
        },
        context: this
      }).then(() => {
        this.$wait.start("loading");
        store.dispatch("category/fetchCategories").then(() => {
            this.$wait.end("loading");
        });

        const getToken = localStorage.getItem('localforage/wimm_cms/intended');

        if (!isEmpty(getToken)) {
          this.$buefy.snackbar.open({
            message: 'Your category is successfully created!',
            type: 'is-success',
            position: 'is-top',
          })
          this.$router.push('/category/' + getToken)
        }
      });
    },
    deleteDropFile() {
      this.thumbnail = null;
    }
  },
  computed: mapState({
    topCategories: state => state.topCategory.topCategories.category
  }),
  mounted() {
    this.$wait.start("loading");
    hljs.registerLanguage("javascript", javascript);

    store.dispatch('topCategory/fetchTopCategories').then(() => {
      this.$wait.end("loading");
    });
  }
};
</script>
<style type="text/scss">
.quill-editor {
  z-index: 1000;
}
</style>