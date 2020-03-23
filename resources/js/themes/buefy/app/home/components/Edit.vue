<template>
  <div class="container">
    <div class="columns">
      <div class="column is-2">
        <AdminMenu />
      </div>
      <div class="column is-10">
        <div class="box m-t-50">
          <b-tabs class="block">
            <b-tab-item label="Blocks" icon="pencil-alt">
              <b-field label="Page name" :labelPosition="labelPosition">
                <b-input v-model="form.name" value="Home"></b-input>
              </b-field>
              <b-field label="Display name (in menu)" :labelPosition="labelPosition">
                <b-input v-model="form.displayName" value="Home"></b-input>
              </b-field>

              <b-field label="Show Articles on home page" :labelPosition="labelPosition">
                <b-radio-button v-model="form.showArticles" native-value="1" type="is-success">Yes</b-radio-button>

                <b-radio-button v-model="form.showArticles" native-value="0" type="is-danger">No</b-radio-button>
              </b-field>

              <template v-if="form.showArticles == true">
                <b-field label="Sort Articles By" :labelPosition="labelPosition">
                  <b-radio-button v-model="form.sortBy" native-value="new" type="is-success">Newest</b-radio-button>

                  <b-radio-button v-model="form.sortBy" native-value="old" type="is-success">Oldest</b-radio-button>
                </b-field>

                <b-field label="Layout" :labelPosition="labelPosition">
                  <b-select v-model="form.layout" placeholder="Layout for articles">
                    <option value="vertical">Vertical</option>
                    <option value="vertical">Vertical with categories</option>
                    <option value="horizontal">Horizontal</option>
                    <option value="horizontalWithCategories">Horizontal with categories</option>
                    <option value="mix">Mixture of horizontal and vertical</option>
                    <option
                      value="mixWithCategories"
                    >Mixture of horizontal and vertical with categories</option>
                  </b-select>
                </b-field>
              </template>

              <b-field
                v-bind:message="errors.thumbnail"
                v-bind:type="errors.thumbnail ? 'is-danger' : ''"
                class="file"
              >
                <b-upload accept="image/*" drag-drop v-model="form.thumbnail">
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
              <div class="tags" v-if="form.thumbnail">
                <span class="tag is-primary">
                  {{ form.thumbnail.name }}
                  <button
                    class="delete is-small"
                    type="button"
                    @click="deleteDropFile"
                  ></button>
                </span>
              </div>
            </b-tab-item>
            <b-tab-item label="Settings" icon="cog"></b-tab-item>
          </b-tabs>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      labelPosition: "on-border",
      form: {
        name: "Home",
        displayName: "Home",
        sortBy: "new",
        layout: "vertical",
        thumbnail: null,
        showArticles: null
      },
      errors: []
    };
  },
  methods: {
    deleteDropFile() {
      this.form.thumbnail = null;
    }
  }
};
</script>